@extends('layouts.app')
@section('title', 'Stock Adjustments')

@section('content')
<div class="container">
    <h4 class="mb-4">📋 Stock Adjustments</h4>

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <span>Stock Adjustments List</span>
            <a href="{{ route('adjustments.create') }}" class="btn btn-light btn-sm">New Adjustment</a>
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered table-sm mb-0">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Store</th>
                        <th>Type</th>
                        <th>Qty</th>
                        <th>Reason</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($adjustments as $adj)
                    <tr>
                        <td>{{ $adj->item->name }}</td>
                        <td>{{ $adj->store->name }}</td>
                        <td><span class="badge bg-secondary">{{ ucfirst($adj->adjustment_type) }}</span></td>
                        <td class="{{ $adj->quantity < 0 ? 'text-danger' : 'text-success' }}">{{ $adj->quantity }}</td>
                        <td>{{ $adj->reason }}</td>
                        <td>{{ $adj->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
