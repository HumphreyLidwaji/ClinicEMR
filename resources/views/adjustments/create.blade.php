@extends('layouts.app')
@section('title', 'New Stock Adjustment')

@section('content')
<div class="container">
    <h4 class="mb-4">📋 New Stock Adjustment</h4>

    <form method="POST" action="{{ route('adjustments.store') }}">
        @csrf

        <div class="mb-3">
            <label>Item</label>
            <select name="item_id" class="form-control" required>
                <option value="">-- Select --</option>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Store</label>
            <select name="store_id" class="form-control" required>
                <option value="">-- Select --</option>
                @foreach($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Adjustment Type</label>
                <select name="adjustment_type" class="form-control" required>
                    <option value="damage">Damage</option>
                    <option value="loss">Loss</option>
                    <option value="correction">Correction</option>
                    <option value="opening">Opening Stock</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Quantity (use negative for deduction)</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Reason</label>
            <textarea name="reason" class="form-control"></textarea>
        </div>

        <button class="btn btn-primary">Adjust Stock</button>
    </form>
</div>
@endsection
