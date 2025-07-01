@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Sales Report</h4>

    <form method="GET" class="row mb-4">
        <div class="col-md-3">
            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>
        <div class="col-md-3">
            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary">Filter</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Date</th>
                <th>Drug</th>
                <th>Type</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $sale)
                <tr>
                    <td>{{ $sale->created_at->format('Y-m-d') }}</td>
                    <td>{{ $sale->drug->name }}</td>
                    <td>{{ strtoupper($sale->sale_type) }}</td>
                    <td>{{ $sale->quantity }}</td>
                    <td>{{ number_format($sale->price, 2) }}</td>
                    <td>{{ number_format($sale->total, 2) }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted">No sales found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
