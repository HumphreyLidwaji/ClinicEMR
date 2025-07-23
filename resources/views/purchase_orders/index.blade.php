@extends('layouts.app')
@section('title', 'Purchase Orders')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Purchase Orders</h4>
            <a href="{{ route('purchase-orders.create') }}" class="btn btn-light btn-sm">New Order</a>
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Supplier</th>
                        <th>Order Date</th>
                        <th>Expected Delivery</th>
                        <th>Status</th>
                        <th>Items</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->supplier_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('M d, Y') }}</td>
                        <td>{{ $order->expected_date ? \Carbon\Carbon::parse($order->expected_date)->format('M d, Y') : '-' }}</td>
                        <td><span class="badge bg-info">{{ ucfirst($order->status) }}</span></td>
                        <td>{{ $order->items->count() }}</td>
                        <td>
                            <a href="{{ route('purchase-orders.show', $order) }}" class="btn btn-sm btn-success">View</a>
                            <form action="{{ route('purchase-orders.destroy', $order) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this order?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No purchase orders found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
