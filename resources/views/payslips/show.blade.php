@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Payslip Details</h5>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <p><strong>Employee:</strong> {{ $payslip->payroll->employee->first_name }} {{ $payslip->payroll->employee->last_name }}</p>
                <p><strong>Month:</strong> {{ $payslip->payroll->pay_month }}</p>
                <p><strong>Net Salary:</strong> KES {{ number_format($payslip->payroll->net_salary, 2) }}</p>
            </div>

            @if(!empty($payslip->earnings))
                <h6 class="fw-bold">Earnings</h6>
                <ul class="list-group mb-3">
                    @foreach($payslip->earnings as $label => $amount)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $label }}</span>
                            <span>KES {{ number_format($amount, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif

            @if(!empty($payslip->deductions))
                <h6 class="fw-bold">Deductions</h6>
                <ul class="list-group mb-3">
                    @foreach($payslip->deductions as $label => $amount)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $label }}</span>
                            <span>KES {{ number_format($amount, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif

            @if($payslip->notes)
                <div class="mb-3">
                    <h6 class="fw-bold">Notes</h6>
                    <p class="text-muted">{{ $payslip->notes }}</p>
                </div>
            @endif

            <a href="{{ route('payslips.download', $payslip) }}" class="btn btn-outline-success">Download PDF</a>
        </div>
    </div>
</div>
@endsection
