@extends('layouts.app')
@section('title', 'New Purchase Order')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">📝 New Purchase Order</h5>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('inventory.purchase_orders.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">PO Number</label>
                    <input name="po_number" type="text" class="form-control" required value="{{ old('po_number') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Supplier</label>
                    <select name="supplier_id" class="form-control" required>
                        <option value="">Select Supplier</option>
                        @foreach($vendors as $vendor)
                            <option value="{{ $vendor->id }}" @if(old('supplier_id') == $vendor->id) selected @endif>
                                {{ $vendor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="pending" @if(old('status') == 'pending') selected @endif>Pending</option>
                        <option value="approved" @if(old('status') == 'approved') selected @endif>Approved</option>
                        <option value="received" @if(old('status') == 'received') selected @endif>Received</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Expected Date</label>
                    <input name="expected_date" type="date" class="form-control" required value="{{ old('expected_date') }}">
                </div>

                <div class="d-flex justify-content-between">
                    <button class="btn btn-success">💾 Save Purchase Order</button>
                    <a href="{{ route('inventory.purchase_orders.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
