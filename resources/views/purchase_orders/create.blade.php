@extends('layouts.app')
@section('title', 'New Purchase Order')

@section('content')
<div class="container">
    <h4 class="mb-4">New Purchase Order</h4>

    <form method="POST" action="{{ route('purchase-orders.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Supplier Name</label>
            <input type="text" name="supplier_name" class="form-control" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Order Date</label>
                <input type="date" name="order_date" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Expected Delivery Date</label>
                <input type="date" name="expected_date" class="form-control">
            </div>
        </div>

        <h5>Items</h5>
        <table class="table table-bordered" id="items-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="items[0][item_id]" class="form-control" required>
                            <option value="">-- Select --</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="items[0][quantity]" class="form-control" required></td>
                    <td><input type="number" name="items[0][unit_price]" class="form-control" required></td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>
                </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-sm btn-secondary mb-3" id="add-row">+ Add Item</button>

        <button type="submit" class="btn btn-primary">Submit Order</button>
    </form>
</div>

@push('scripts')
<script>
    let rowIndex = 1;
    document.getElementById('add-row').addEventListener('click', function() {
        const row = `
            <tr>
                <td>
                    <select name="items[${rowIndex}][item_id]" class="form-control" required>
                        <option value="">-- Select --</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="items[${rowIndex}][quantity]" class="form-control" required></td>
                <td><input type="number" name="items[${rowIndex}][unit_price]" class="form-control" required></td>
                <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>
            </tr>`;
        document.querySelector('#items-table tbody').insertAdjacentHTML('beforeend', row);
        rowIndex++;
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
        }
    });
</script>
@endpush
@endsection
