
{{-- resources/views/billing/view_invoice.blade.php --}}
@extends('layouts.app')

@section('title', 'View Invoice')

@section('content')
<div class="container py-4">
    <div class="card-box bg-white box-shadow border-radius-10 mb-4">
        <div class="pd-20">
            <h4 class="mb-4">Invoice #{{ $invoice->invoice_number }}</h4>
            <div class="mb-3">
                <strong>Patient:</strong> {{ $invoice->patient_name }}<br>
                <strong>Visit Type:</strong> {{ $invoice->visit_type }}<br>
                <strong>Status:</strong>
                <span class="badge bg-{{ $invoice->status == 'Paid' ? 'success' : 'warning' }}">
                    {{ $invoice->status }}
                </span><br>
                <strong>Issued At:</strong> {{ $invoice->created_at->format('Y-m-d') }}
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice->items as $item)
                        <tr>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->unit_price, 2) }}</td>
                            <td>{{ number_format($item->total, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Total Amount</th>
                            <th>{{ number_format($invoice->amount, 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <a href="{{ route('billing.invoices.print', $invoice->id) }}" class="btn btn-secondary mt-3" target="_blank">
                <i class="fas fa-print"></i> Print Invoice
            </a>
            <a href="{{ route('billing.invoices') }}" class="btn btn-light mt-3">Back to Invoices</a>
        </div>
    </div>
</div>
@endsection