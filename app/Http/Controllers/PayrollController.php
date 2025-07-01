<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::with('employee')->orderBy('pay_month', 'desc')->get();
        return view('payrolls.index', compact('payrolls'));
    }

    public function create()
    {
        $employees = Employee::where('is_active', 1)->get();
        return view('payrolls.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pay_month' => 'required|date_format:Y-m',
        ]);

        $employees = Employee::where('is_active', 1)->get();

        foreach ($employees as $employee) {
            $basic = $employee->basic_salary ?? 0;

            // For now, flat 15% deduction. Later connect to deductions table
            $deductions = $basic * 0.15;
            $net = $basic - $deductions;

            Payroll::updateOrCreate([
                'employee_id' => $employee->id,
                'pay_month' => $request->pay_month,
            ], [
                'basic_salary' => $basic,
                'total_deductions' => $deductions,
                'net_salary' => $net,
                'processed_by' => auth()->id(),
            ]);
        }

        return redirect()->route('payrolls.index')->with('success', 'Payroll run for ' . $request->pay_month);
    }

    public function show(Payroll $payroll)
    {
        return view('payrolls.show', compact('payroll'));
    }
}
