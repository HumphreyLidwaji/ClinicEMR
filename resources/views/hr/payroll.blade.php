@extends('layouts.app')
@section('title', 'Payroll')

@section('content')
<div class="container">
    <h4 class="mb-4">Payroll Management</h4>
    <a href="{{ route('hr.payroll.generate') }}" class="btn btn-success mb-3">Generate Payroll</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Month</th>
                <th>Employee</th>
                <th>Gross Pay</th>
                <th>Deductions</th>
                <th>Net Pay</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payrolls as $pay)
            <tr>
                <td>{{ $pay->month }}</td>
                <td>{{ $pay->employee->name }}</td>
                <td>{{ number_format($pay->gross, 2) }}</td>
                <td>{{ number_format($pay->deductions, 2) }}</td>
                <td>{{ number_format($pay->net, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
