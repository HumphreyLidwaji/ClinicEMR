@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Radiology Orders</h4>
            <a href="{{ route('orders.create') }}" class="btn btn-light btn-sm">Add Order</a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Visit</th>
                            <th>Test Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th> {{-- New column --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->visit->id ?? '-' }}</td>
                            <td>{{ $order->imagingTest->name ?? '-' }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ number_format($order->price, 2) }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                         <td>
    @if(is_null($order->result))
      <a href="{{ route('radiology.results.create', ['orderId' => $order->id]) }}" class="btn btn-sm btn-primary">
    Add Result
</a>
    @elseif($order->result->status === 'pending')
        <a href="{{ route('radiology.results.edit', $order->result->id) }}" class="btn btn-sm btn-warning">
            Edit Result
    @else
        <a href="{{ route('radiology.results.show', $order->result->id) }}" class="btn btn-sm btn-info">
            View Result
        </a>
    @endif
</td>

                        </tr>
                        @endforeach
                        @if($orders->isEmpty())
                            <tr><td colspan="7" class="text-center">No radiology orders found.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
