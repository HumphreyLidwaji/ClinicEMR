@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Payroll Summary</h4>

    <table class="table">
        <tr><th>Employee</th><td>{{ $payroll->employee->first_name }} {{ $payroll->employee->last_name }}</td></tr>
        <tr><th>Month</th><td>{{ $payroll->pay_month }}</td></tr>
        <tr><th>Basic Salary</th><td>{{ number_format($payroll->basic_salary, 2) }}</td></tr>
        <tr><th>Total Deductions</th><td>{{ number_format($payroll->total_deductions, 2) }}</td></tr>
        <tr><th>Net Salary</th><td><strong>{{ number_format($payroll->net_salary, 2) }}</strong></td></tr>
        <tr><th>Processed By</th><td>{{ $payroll->processor?->name }}</td></tr>
    </table>

    <a href="{{ route('payrolls.index') }}" class="btn btn-secondary">Back to Payrolls</a>
</div>
@endsection
