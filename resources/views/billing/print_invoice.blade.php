
{{-- resources/views/billing/print_invoice.blade.php --}}
@extends('layouts.app')

@section('title', 'Print Invoice')

@section('content')
<div class="container py-4" id="print-area">
    <div class="card-box bg-white border-radius-10 mb-4">
        <div class="pd-20">
            <h3 class="mb-4 text-center">Invoice #{{ $invoice->invoice_number }}</h3>
            <div class="mb-3">
                <strong>Patient:</strong> {{ $invoice->patient_name }}<br>
                <strong>Visit Type:</strong> {{ $invoice->visit_type }}<br>
                <strong>Status:</strong> {{ $invoice->status }}<br>
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
        </div>
    </div>
</div>
<script>
    window.onload = function() {
        window.print();
    };
</script>
@endsection