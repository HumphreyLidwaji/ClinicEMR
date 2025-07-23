@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Receive Stock</h4>

    <form action="{{ route('stock.receive.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Drug</label>
                <select name="drug_id" class="form-select" required>
                    <option value="">-- Select Drug --</option>
                    @foreach($drugs as $drug)
                        <option value="{{ $drug->id }}">{{ $drug->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label>Batch Number</label>
                <input type="text" name="batch_number" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label>Expiry Date</label>
                <input type="date" name="expiry_date" class="form-control">
            </div>
            <div class="col-md-4">
                <label>Quantity Received</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label>Unit Price</label>
                <input type="number" step="0.01" name="unit_price" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-success">Receive</button>
    </form>
</div>
@endsection

