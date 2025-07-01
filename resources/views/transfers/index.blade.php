@extends('layouts.app')
@section('title', 'Stock Transfers')

@section('content')
<div class="container">
    <h4 class="mb-4">Stock Transfers</h4>
    <a href="{{ route('transfers.create') }}" class="btn btn-primary mb-3">New Transfer</a>

    <table class="table table-bordered">
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
@endsection
