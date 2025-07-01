@extends('layouts.app')
@section('title', 'Purchase Orders')

@section('content')
<div class="container">
    <h4 class="mb-4">Purchase Orders</h4>
    <a href="{{ route('purchase-orders.create') }}" class="btn btn-primary mb-3">New Order</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Supplier</th>
                <th>Date</th>
                <th>Expected</th>
                <th>Status</th>
                <th>Items</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->supplier_name }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ $order->expected_date }}</td>
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
        @endforeach
        </tbody>
    </table>
</div>
@endsection
