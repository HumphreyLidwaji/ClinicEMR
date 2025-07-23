@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4"><i class="bi bi-cash-coin"></i> Direct Sale (OTC)</h4>

    <div class="card shadow-sm">
        <div class="card-header bg-light fw-semibold">
            Enter Sale Details
        </div>

        <div class="card-body">
            <form action="{{ route('sales.store') }}" method="POST" id="otcSaleForm">
                @csrf

                <div class="row g-4 align-items-end">
                    <div class="col-md-6">
                        <label for="drug_id" class="form-label">Select Drug</label>
                        <select name="drug_id" id="drug_id" class="form-select" required>
                            <option value="" disabled selected>-- Choose Drug --</option>
                            @foreach($drugs as $drug)
                                <option value="{{ $drug->id }}" data-price="{{ $drug->price }}">
                                    {{ $drug->name }} (KES {{ number_format($drug->price, 2) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
                    </div>

                    <div class="col-md-3">
                        <label for="price" class="form-label">Price per Unit (KES)</label>
                        <input type="number" step="0.01" name="price" id="price" class="form-control" required>
                    </div>
                </div>

                <div class="row mt-4 align-items-center">
                    <div class="col-md-6 offset-md-6">
                        <div class="text-end">
                            <label class="form-label fw-bold">Total (KES)</label>
                            <input type="text" id="total" class="form-control-plaintext text-end fw-bold text-success" readonly value="0.00">
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle-fill me-1"></i> Submit Sale
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const drugSelect = document.getElementById('drug_id');
        const priceInput = document.getElementById('price');
        const quantityInput = document.getElementById('quantity');
        const totalDisplay = document.getElementById('total');

        function calculateTotal() {
            const qty = parseFloat(quantityInput.value) || 0;
            const price = parseFloat(priceInput.value) || 0;
            totalDisplay.value = (qty * price).toFixed(2);
        }

        drugSelect.addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];
            const price = selected.getAttribute('data-price');
            if (price) {
                priceInput.value = parseFloat(price).toFixed(2);
                calculateTotal();
            }
        });

        quantityInput.addEventListener('input', calculateTotal);
        priceInput.addEventListener('input', calculateTotal);
    });
</script>
@endpush
