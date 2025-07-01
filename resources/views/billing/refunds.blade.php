@extends('layouts.app')

@section('title', 'Refunds')

@section('content')
<div class="container-fluid py-4">
    <div class="card-box bg-white box-shadow border-radius-10">
        <div class="pd-20">
            <h4 class="mb-4">{{ __('Refunds') }}</h4>

            <a href="#" class="btn btn-danger mb-3">
                <i class="fas fa-undo"></i> {{ __('New Refund') }}
            </a>

            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>{{ __('Refund #') }}</th>
                            <th>{{ __('Patient') }}</th>
                            <th>{{ __('Invoice #') }}</th>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('Reason') }}</th>
                            <th>{{ __('Refunded On') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($refunds ?? [] as $refund)
                            <tr>
                                <td>{{ $refund->refund_number }}</td>
                                <td>{{ $refund->patient_name }}</td>
                                <td>{{ $refund->invoice_number }}</td>
                                <td>{{ number_format($refund->amount, 2) }}</td>
                                <td>{{ $refund->reason }}</td>
                                <td>{{ $refund->refunded_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-dark">{{ __('Print') }}</a>
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