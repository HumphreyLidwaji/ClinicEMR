@extends('layouts.app')
@section('title', 'Inventory Dashboard')

@section('content')
<div class="container">
    <h4 class="mb-4">📦 Inventory Dashboard</h4>

    <div class="row text-white mb-4">
        <div class="col-md-4">
            <div class="card bg-primary shadow">
                <div class="card-body text-center">
                    <h5>Total Items</h5>
                    <h3>{{ $totalItems }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success shadow">
                <div class="card-body text-center">
                    <h5>Total Stock Quantity</h5>
                    <h3>{{ $totalQuantity }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-dark shadow">
                <div class="card-body text-center">
                    <h5>Total Stock Value</h5>
                    <h3>KES {{ number_format($totalStockValue, 2) }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Low Stock Alerts --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-danger text-white">
            🚨 Low Stock Alerts
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-sm mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Item</th>
                            <th>Reorder Level</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($lowStockItems as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->reorder_level }}</td>
                            <td>{{ $item->stocks->sum('quantity') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center">No items below reorder level.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Recent GRNs --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-info text-white">
            📥 Recent GRNs
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-sm mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>GRN ID</th>
                            <th>Store</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($recentGRNs as $grn)
                        <tr>
                            <td>#{{ $grn->id }}</td>
                            <td>{{ $grn->store->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($grn->received_date ?? $grn->created_at)->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Recent Transfers --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-secondary text-white">
            🔁 Recent Transfers
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-sm mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Item</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Qty</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($recentTransfers as $t)
                        <tr>
                            <td>{{ $t->item->name }}</td>
                            <td>{{ $t->fromStore->name }}</td>
                            <td>{{ $t->toStore->name }}</td>
                            <td>{{ $t->quantity }}</td>
                            <td>{{ \Carbon\Carbon::parse($t->transfer_date)->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Stock On Hand --}}
    @foreach($stockPerStore as $storeId => $stockList)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-success text-white">
                🏬 Stock on Hand – {{ $stockList->first()->store->name }}
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($stockList as $s)
                            <tr>
                                <td>{{ $s->item->name }}</td>
                                <td>{{ $s->quantity }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
