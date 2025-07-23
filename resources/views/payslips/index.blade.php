@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Payslips</h5>
            <a href="{{ route('payslips.create') }}" class="btn btn-light btn-sm">Generate Payslip</a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Employee</th>
                            <th>Month</th>
                            <th>Net Pay</th>
                            <th>Actions</th>
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
        </div>
    </div>
</div>
@endsection
