@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Payslips</h4>

    <a href="{{ route('payslips.create') }}" class="btn btn-primary mb-3">Generate Payslip</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Employee</th><th>Month</th><th>Net Pay</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($payslips as $p)
            <tr>
                <td>{{ $p->payroll->employee->first_name }} {{ $p->payroll->employee->last_name }}</td>
                <td>{{ $p->payroll->pay_month }}</td>
                <td>{{ number_format($p->payroll->net_salary, 2) }}</td>
                <td>
                    <a href="{{ route('payslips.show', $p) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('payslips.download', $p) }}" class="btn btn-sm btn-secondary">PDF</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
