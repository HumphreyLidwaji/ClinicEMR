
@extends('layouts.app')
@section('title', 'New Stock Transfer')

@section('content')
<div class="container">
    <h4 class="mb-4">New Stock Transfer</h4>
    <form method="POST" action="{{ route('inventory.transfers.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Item</label>
            <select name="item_id" class="form-control" required>
                <option value="">Select Item</option>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">From Store</label>
            <select name="from_store_id" class="form-control" required>
                <option value="">Select Store</option>
                @foreach($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">To Store</label>
            <select name="to_store_id" class="form-control" required>
                <option value="">Select Store</option>
                @foreach($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input name="quantity" type="number" class="form-control" min="1" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Transfer Date</label>
            <input name="transfer_date" type="date" class="form-control" required>
        </div>
        <button class="btn btn-success">Save Transfer</button>
        <a href="{{ route('inventory.transfers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection