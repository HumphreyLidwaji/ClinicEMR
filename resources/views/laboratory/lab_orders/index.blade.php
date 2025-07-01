
@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-white">Lab Orders</h4>
            <a href="{{ route('lab_orders.create') }}" class="btn btn-light btn-sm">Add Lab Order</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Visit</th>
                            <th>Lab Test</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->visit->id ?? '-' }}</td>
                            <td>{{ $order->labTest->name ?? '-' }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ number_format($order->price, 2) }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                          <td>
    @if($order->visit && $order->visit->patient)
        <a href="{{ route('sample_collections.create', $order->id) }}" class="btn btn-sm btn-primary mb-1">
            Collect Sample
        </a>
        <a href="{{ route('lab_results.create', $order->id) }}" class="btn btn-sm btn-success">
            Enter Result
        </a>
    @else
        <span class="text-muted">N/A</span>
    @endif
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