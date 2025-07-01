
@extends('layouts.app')

@section('title', 'GRN Details')

@section('content')
<div class="container">
    <h4 class="mb-4">Goods Received Note #{{ $grn->id }}</h4>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Purchase Order:</strong> {{ $grn->purchase_order_id }}</p>
            <p><strong>Received By:</strong> {{ $grn->received_by }}</p>
            <p><strong>Received Date:</strong> {{ $grn->received_date }}</p>
            <p><strong>Store:</strong> {{ $grn->store->name ?? 'N/A' }}</p>
            <p><strong>Notes:</strong> {{ $grn->notes }}</p>
        </div>
    </div>

    <h5>Items Received</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Item</th>
                <th>Received Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grn->items as $item)
                <tr>
                    <td>{{ $item->item->name ?? '-' }}</td>
                    <td>{{ $item->received_quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
