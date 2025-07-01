<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HR\PayrollDeduction;

class PayrollDeductionController extends Controller
{
    public function index()
    {
        $deductions = PayrollDeduction::all();
        return view('hr.payroll_deductions.index', compact('deductions'));
    }

    public function create()
    {
        return view('hr.payroll_deductions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        PayrollDeduction::create($data);
        return redirect()->route('payroll-deductions.index')->with('success', 'Payroll Deduction created successfully.');
    }

    public function show(PayrollDeduction $payrollDeduction)
    {
        return view('hr.payroll_deductions.show', compact('payrollDeduction'));
    }

    public function edit(PayrollDeduction $payrollDeduction)
    {
        return view('hr.payroll_deductions.edit', compact('payrollDeduction'));
    }

    public function update(Request $request, PayrollDeduction $payrollDeduction)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $payrollDeduction->update($data);
        return redirect()->route('payroll-deductions.index')->with('success', 'Payroll Deduction updated successfully.');
    }

    public function destroy(PayrollDeduction $payrollDeduction)
    {
        $payrollDeduction->delete();
        return redirect()->route('payroll-deductions.index')->with('success', 'Payroll Deduction deleted successfully.');
    }
}
