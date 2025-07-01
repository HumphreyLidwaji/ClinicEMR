@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">OTC Sales</h4>

    <a href="{{ route('sales.create') }}" class="btn btn-sm btn-success mb-3">+ New Sale</a>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Date</th>
                <th>Drug</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $sale)
                <tr>
                    <td>{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ $sale->drug->name }}</td>
                    <td>{{ $sale->quantity }}</td>
                    <td>{{ number_format($sale->price, 2) }}</td>
                    <td>{{ number_format($sale->total, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No sales found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
