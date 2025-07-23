@extends('layouts.app')
@section('title', 'Stock Transfers')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Stock Transfers</h4>
            <a href="{{ route('transfers.create') }}" class="btn btn-light btn-sm">New Transfer</a>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Item</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Qty</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($transfers as $transfer)
                    <tr>
                        <td>{{ $transfer->transfer_date }}</td>
                        <td>{{ $transfer->item->name }}</td>
                        <td>{{ $transfer->fromStore->name }}</td>
                        <td>{{ $transfer->toStore->name }}</td>
                        <td>{{ $transfer->quantity }}</td>
                        <td>{{ $transfer->notes }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
