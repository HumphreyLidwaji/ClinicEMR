@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Adjust Stock</h4>

    <form action="{{ route('stock.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="drug_id" class="form-label">Drug</label>
            <select name="drug_id" class="form-select" required>
                <option value="">-- Select Drug --</option>
                @foreach($drugs as $drug)
                    <option value="{{ $drug->id }}">{{ $drug->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
            <small class="text-muted">Use positive value for addition, negative for deduction</small>
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Reason</label>
            <input type="text" name="reason" class="form-control" placeholder="e.g., Correction, Loss, Donation">
        </div>

        <button type="submit" class="btn btn-success">Submit Adjustment</button>
    </form>
</div>
@endsection
