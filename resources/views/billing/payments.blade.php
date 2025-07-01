@extends('layouts.app')

@section('title', 'Payments')

@section('content')
<div class="container-fluid py-4">
            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Messages --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    <div class="card-box bg-white box-shadow border-radius-10">
        <div class="pd-20">
         
<a href="{{ route('billing.payments.index') }}" class="btn btn-primary">Payments</a>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>{{ __('Payment #') }}</th>
                            <th>{{ __('Invoice #') }}</th>
                            <th>{{ __('Patient') }}</th>
                            <th>{{ __('Method') }}</th>
                            <th>{{ __('Amount Paid') }}</th>
                            <th>{{ __('Paid On') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments ?? [] as $payment)
                            <tr>
                                <td>{{ $payment->payment_number }}</td>
                                <td>{{ $payment->invoice_number }}</td>
                                <td>{{ $payment->patient_name }}</td>
                                <td>{{ $payment->method }}</td>
                                <td>{{ number_format($payment->amount, 2) }}</td>
                                <td>{{ $payment->date ? $payment->paid_at->format('Y-m-d') : '-' }}</td>

                                <td>
                                    <a href="#" class="btn btn-sm btn-secondary">{{ __('Receipt') }}</a>
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