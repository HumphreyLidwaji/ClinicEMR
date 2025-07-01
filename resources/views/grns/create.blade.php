@extends('layouts.app')
@section('title', 'Create GRN')

@section('content')
<div class="container">
    <h4 class="mb-4">Create GRN</h4>

    <form method="POST" action="{{ route('grns.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Purchase Order</label>
            <select name="purchase_order_id" id="purchase_order_id" class="form-control" required>
                <option value="">-- Select PO --</option>
                @foreach($purchaseOrders as $po)
                    <option value="{{ $po->id }}" data-items="{{ json_encode($po->items) }}">
                        #{{ $po->id }} - {{ $po->supplier_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Store</label>
            <select name="store_id" class="form-control" required>
                <option value="">-- Select Store --</option>
                @foreach($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                @endforeach
            </select>
        </div>

        <div id="items-container" class="mt-4">
            <h5>Items</h5>
            <table class="table table-bordered">
                <thead><tr><th>Item</th><th>Qty Ordered</th><th>Qty Received</th></tr></thead>
                <tbody id="items-table"></tbody>
            </table>
        </div>

        <div class="mb-3">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit GRN</button>
    </form>
</div>

@push('scripts')
<script>
    const purchaseOrders = @json($purchaseOrders);

    document.getElementById('purchase_order_id').addEventListener('change', function () {
        const selectedId = this.value;
        const po = purchaseOrders.find(p => p.id == selectedId);
        let html = '';

        if (po) {
            po.items.forEach((item, index) => {
                html += `
                    <tr>
                        <td>${item.item.name}</td>
                        <td>${item.quantity}</td>
                        <td>
                            <input type="hidden" name="items[${index}][item_id]" value="${item.item_id}">
                            <input type="number" name="items[${index}][received_quantity]" class="form-control" required>
                        </td>
                    </tr>
                `;
            });
        }

        document.getElementById('items-table').innerHTML = html;
    });
</script>
@endpush
@endsection
