@extends('layouts.app')
@section('title', 'New Requisition')

@section('content')
<div class="container">
    <h4 class="mb-4">Create Requisition</h4>

    <form action="{{ route('requisitions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="store_id" class="form-label">Requesting Store</label>
            <select name="store_id" class="form-control" required>
                @foreach($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                @endforeach
            </select>
        </div>

        <div id="items-wrapper">
            <h5>Items Requested</h5>
            <div class="item-row row mb-2">
                <div class="col-md-5">
                    <select name="items[0][item_id]" class="form-control" required>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="number" name="items[0][quantity]" class="form-control" placeholder="Quantity" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="items[0][remarks]" class="form-control" placeholder="Remarks">
                </div>
            </div>
        </div>

        <button type="button" onclick="addItemRow()" class="btn btn-secondary mb-3">Add Item</button>

        <div class="mb-3">
            <label for="notes">Additional Notes</label>
            <textarea name="notes" class="form-control"></textarea>
        </div>

        <button class="btn btn-primary">Submit Requisition</button>
    </form>
</div>

<script>
    let rowIndex = 1;
    function addItemRow() {
        const row = `
        <div class="item-row row mb-2">
            <div class="col-md-5">
                <select name="items[${rowIndex}][item_id]" class="form-control" required>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="items[${rowIndex}][quantity]" class="form-control" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="items[${rowIndex}][remarks]" class="form-control">
            </div>
        </div>`;
        document.getElementById('items-wrapper').insertAdjacentHTML('beforeend', row);
        rowIndex++;
    }
</script>
@endsection
