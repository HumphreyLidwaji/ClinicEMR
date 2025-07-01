@extends('layouts.app')
@section('title', 'New Stock Transfer')

@section('content')
<div class="container">
    <h4 class="mb-4">New Stock Transfer</h4>

    <form method="POST" action="{{ route('transfers.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Item</label>
            <select name="item_id" class="form-control" required>
                <option value="">-- Select --</option>
                @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">From Store</label>
                <select name="from_store_id" class="form-control" required>
                    <option value="">-- Select --</option>
                    @foreach ($stores as $store)
                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">To Store</label>
                <select name="to_store_id" class="form-control" required>
                    <option value="">-- Select --</option>
                    @foreach ($stores as $store)
                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" required min="1">
        </div>

        <div class="mb-3">
            <label class="form-label">Transfer Date</label>
            <input type="date" name="transfer_date" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control"></textarea>
        </div>

        <button class="btn btn-primary">Transfer</button>
    </form>
</div>
@endsection
