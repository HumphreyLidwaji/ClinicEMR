@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Payslip Details</h4>

    <p><strong>Employee:</strong> {{ $payslip->payroll->employee->first_name }}</p>
    <p><strong>Month:</strong> {{ $payslip->payroll->pay_month }}</p>
    <p><strong>Net Salary:</strong> {{ number_format($payslip->payroll->net_salary, 2) }}</p>

    <h5>Earnings</h5>
    <ul>
        @foreach($payslip->earnings ?? [] as $label => $amount)
            <li>{{ $label }}: {{ $amount }}</li>
        @endforeach
    </ul>

    <h5>Deductions</h5>
    <ul>
        @foreach($payslip->deductions ?? [] as $label => $amount)
            <li>{{ $label }}: {{ $amount }}</li>
        @endforeach
    </ul>

    <p><strong>Notes:</strong> {{ $payslip->notes }}</p>

    <a href="{{ route('payslips.download', $payslip) }}" class="btn btn-success">Download PDF</a>
</div>
@endsection
