@extends('layouts.app')
@section('title', 'Inventory Dashboard')

@section('content')
<div class="container">
    <h4 class="mb-4">📦 Inventory Dashboard</h4>

    <div class="row text-white mb-4">
        <div class="col-md-4">
            <div class="card bg-primary shadow p-3">
                <h5>Total Items</h5>
                <h3>{{ $totalItems }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success shadow p-3">
                <h5>Total Stock Quantity</h5>
                <h3>{{ $totalQuantity }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-dark shadow p-3">
                <h5>Total Stock Value</h5>
                <h3>KES {{ number_format($totalStockValue, 2) }}</h3>
            </div>
        </div>
    </div>

    <h5 class="mt-4">🚨 Low Stock Alerts</h5>
    <table class="table table-bordered table-sm">
        <thead><tr><th>Item</th><th>Reorder Level</th><th>Stock</th></tr></thead>
        <tbody>
        @forelse($lowStockItems as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->reorder_level }}</td>
                <td>{{ $item->stocks->sum('quantity') }}</td>
            </tr>
        @empty
            <tr><td colspan="3">No items below reorder level.</td></tr>
        @endforelse
        </tbody>
    </table>

    <h5 class="mt-4">📥 Recent GRNs</h5>
    <table class="table table-bordered table-sm">
        <thead><tr><th>GRN ID</th><th>Store</th><th>Date</th></tr></thead>
        <tbody>
        @foreach($recentGRNs as $grn)
            <tr>
                <td>#{{ $grn->id }}</td>
                <td>{{ $grn->store->name }}</td>
                <td>{{ $grn->received_date ?? $grn->created_at->toDateString() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h5 class="mt-4">🔁 Recent Transfers</h5>
    <table class="table table-bordered table-sm">
        <thead><tr><th>Item</th><th>From</th><th>To</th><th>Qty</th><th>Date</th></tr></thead>
        <tbody>
        @foreach($recentTransfers as $t)
            <tr>
                <td>{{ $t->item->name }}</td>
                <td>{{ $t->fromStore->name }}</td>
                <td>{{ $t->toStore->name }}</td>
                <td>{{ $t->quantity }}</td>
                <td>{{ $t->transfer_date }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h5 class="mt-4">🏬 Stock On Hand per Store</h5>
    @foreach($stockPerStore as $storeId => $stockList)
        <h6>{{ $stockList->first()->store->name }}</h6>
        <table class="table table-bordered table-sm">
            <thead><tr><th>Item</th><th>Qty</th></tr></thead>
            <tbody>
            @foreach($stockList as $s)
                <tr><td>{{ $s->item->name }}</td><td>{{ $s->quantity }}</td></tr>
            @endforeach
            </tbody>
        </table>
    @endforeach
</div>
@endsection
