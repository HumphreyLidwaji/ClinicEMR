<?php

namespace App\Http\Controllers;

use App\Models\Payslip;
use Illuminate\Http\Request;
use App\Models\Payroll;
use Barryvdh\DomPDF\Facade\Pdf;

class PayslipController extends Controller
{
    public function index()
    {
        $payslips = Payslip::with('payroll.employee')->latest()->get();
        return view('payslips.index', compact('payslips'));
    }

    public function create()
    {
        $payrolls = Payroll::with('employee')->get();
        return view('payslips.create', compact('payrolls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payroll_id' => 'required|exists:payrolls,id',
            'earnings' => 'nullable|array',
            'deductions' => 'nullable|array',
        ]);

        Payslip::create([
            'payroll_id' => $request->payroll_id,
            'earnings' => $request->earnings,
            'deductions' => $request->deductions,
            'notes' => $request->notes,
            'generated_at' => now(),
        ]);

        return redirect()->route('payslips.index')->with('success', 'Payslip generated.');
    }

    public function show(Payslip $payslip)
    {
        return view('payslips.show', compact('payslip'));
    }

    public function download(Payslip $payslip)
    {
        $pdf = Pdf::loadView('payslips.pdf', compact('payslip'));
        return $pdf->download('payslip_' . $payslip->id . '.pdf');
    }
}
