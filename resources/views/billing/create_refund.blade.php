@extends('layouts.app')

@section('title', 'Process Refund')

@section('content')
<div class="container-fluid py-4">
    <div class="card-box bg-white box-shadow border-radius-10">
        <div class="pd-20">
            <h4 class="mb-4">{{ __('Process Refund') }}</h4>
            <form action="{{ route('billing.refunds.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">{{ __('Select Invoice') }}</label>
                    <select name="invoice_id" class="form-control" required>
                        @foreach ($invoices as $invoice)
                            <option value="{{ $invoice->id }}">
                                {{ $invoice->invoice_number }} - {{ $invoice->patient_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Refund Amount') }}</label>
                    <input type="number" step="0.01" name="amount" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Reason') }}</label>
                    <textarea name="reason" class="form-control" rows="3" required></textarea>
                </div>

                <button class="btn btn-danger">{{ __('Submit Refund') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection