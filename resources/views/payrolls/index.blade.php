@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-success text-white">
            Payroll Records
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('payrolls.create') }}" class="btn btn-primary mb-3">Run Payroll</a>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
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
                    @forelse($payrolls as $p)
                        <tr>
                            <td>{{ $p->employee->first_name }} {{ $p->employee->last_name }}</td>
                            <td>{{ $p->pay_month }}</td>
                            <td>{{ number_format($p->basic_salary, 2) }}</td>
                            <td>{{ number_format($p->total_deductions, 2) }}</td>
                            <td><strong>{{ number_format($p->net_salary, 2) }}</strong></td>
                            <td>{{ $p->processor?->name ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('payrolls.show', $p->id) }}" class="btn btn-sm btn-info">Details</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No payroll records found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
