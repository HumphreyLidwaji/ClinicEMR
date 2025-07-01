@extends('layouts.app')

@section('title', 'Purchase Order Details')

@section('content')
<div class="container mt-4" id="purchase-order-detail">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Purchase Order #{{ $purchaseOrder->order_number ?? $purchaseOrder->id }}</h4>
        <div>
            <a href="{{ route('purchase-orders.index') }}" class="btn btn-secondary me-2">Back</a>
            <button onclick="window.print()" class="btn btn-outline-dark">🖨 Print</button>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">Purchase Order Info</div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-6">
                    <p><strong>Vendor:</strong> {{ $purchaseOrder->vendor->name ?? 'N/A' }}</p>
                    <p><strong>Order Date:</strong> {{ $purchaseOrder->order_date ?? $purchaseOrder->created_at->format('Y-m-d') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Status:</strong> 
                        <span class="badge 
                            @switch($purchaseOrder->status)
                                @case('pending') bg-warning @break
                                @case('approved') bg-success @break
                                @case('rejected') bg-danger @break
                                @default bg-secondary
                            @endswitch">
                            {{ ucfirst($purchaseOrder->status) }}
                        </span>
                    </p>
                    <p><strong>Expected Delivery:</strong> {{ $purchaseOrder->expected_delivery_date ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>

    @if($purchaseOrder->items && $purchaseOrder->items->count())
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white">Ordered Items</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped table-sm align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Unit Cost</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach ($purchaseOrder->items as $index => $item)
                    @php 
                        $lineTotal = $item->quantity * $item->unit_cost;
                        $grandTotal += $lineTotal;
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->item->name ?? 'N/A' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->unit_cost, 2) }}</td>
                        <td>{{ number_format($lineTotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-light">
                        <th colspan="4" class="text-end">Grand Total</th>
                        <th>{{ number_format($grandTotal, 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    @else
    <div class="alert alert-warning">
        No items found for this purchase order.
    </div>
    @endif

    <div class="text-end no-print">
        <a href="{{ route('purchase-orders.edit', $purchaseOrder->id) }}" class="btn btn-outline-primary">✏️ Edit</a>
        <form action="{{ route('purchase-orders.destroy', $purchaseOrder->id) }}" method="POST" class="d-inline-block" 
              onsubmit="return confirm('Are you sure you want to delete this purchase order?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">🗑 Delete</button>
        </form>
    </div>
</div>

{{-- Optional print stylesheet --}}
<style>
@media print {
    body {
        font-size: 12px;
        color: #000;
    }
    .no-print {
        display: none !important;
    }
    .card {
        border: none;
        box-shadow: none;
    }
    .container {
        width: 100%;
        margin: 0;
        padding: 0;
    }
    table {
        width: 100%;
        border-collapse: collapse !important;
    }
}
</style>
@endsection
