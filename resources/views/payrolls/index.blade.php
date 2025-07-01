@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Payroll Records</h4>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    <a href="{{ route('payrolls.create') }}" class="btn btn-primary mb-3">Run Payroll</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Month</th>
                <th>Basic</th>
                <th>Deductions</th>
                <th>Net Pay</th>
                <th>Processed By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($payrolls as $p)
            <tr>
                <td>{{ $p->employee->first_name }} {{ $p->employee->last_name }}</td>
                <td>{{ $p->pay_month }}</td>
                <td>{{ number_format($p->basic_salary, 2) }}</td>
                <td>{{ number_format($p->total_deductions, 2) }}</td>
                <td><strong>{{ number_format($p->net_salary, 2) }}</strong></td>
                <td>{{ $p->processor?->name }}</td>
                <td>
                    <a href="{{ route('payrolls.show', $p->id) }}" class="btn btn-sm btn-info">Details</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
