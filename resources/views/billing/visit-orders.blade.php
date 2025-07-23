@extends('layouts.app')

@section('title', 'Bill Orders for Visit')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-white">Bill Orders for Visit #{{ $visit->id }} </h4>
        </div>

        <div class="card-body">
            {{-- Error Messages --}}
            @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

       <div class="mb-3 d-flex gap-2 flex-wrap">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#addOrderModal" data-type="lab">
                            + Add Lab Order
                        </button>
                        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                            data-bs-target="#addOrderModal" data-type="radiology">
                            + Add Radiology Order
                        </button>
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                            data-bs-target="#addOrderModal" data-type="service">
                            + Add Service Order
                        </button>
                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                            data-bs-target="#addOrderModal" data-type="procedure">
                            + Add Procedure Order
                        </button>
                    </div>
            <form method="POST" action="{{ route('billing.visit-orders.bill', $visit->id) }}">
                @csrf

                <div class="table-responsive">
             

                    <table class="table table-bordered table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>Type</th>
                                <th>Item</th>
                                <th style="width: 10%;">Qty</th>
                                <th style="width: 15%;">Unit Price (KES)</th>
                                <th>Total (KES)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach([
                            ['data' => $labOrders, 'type' => 'lab', 'label' => 'Lab', 'relation' => 'labTest'],
                            ['data' => $radiologyOrders, 'type' => 'radiology', 'label' => 'Radiology', 'relation' =>
                            'radiologyService'],
                            ['data' => $serviceOrders, 'type' => 'service', 'label' => 'Service', 'relation' =>
                            'service'],
                            ['data' => $procedureOrders, 'type' => 'procedure', 'label' => 'Procedure', 'relation' =>
                            'procedure'],
                            ] as $group)
                            @foreach($group['data'] as $order)
                            @php
                            $key = "{$group['type']}_{$order->id}";
                            $isBilled = $order->status !== 'pending';
                            @endphp
                            <tr>
                                <td>
                                    <input type="checkbox" name="orders[]" value="{{ $key }}"
                                        {{ $isBilled ? 'disabled' : '' }}>
                                </td>
                                <td>{{ $group['label'] }}</td>
                                <td>
                                    {{ $order->{$group['relation']}->name ?? 'N/A' }}
                                    @if($isBilled)
                                    <span class="badge bg-success">✔ Billed</span>
                                    @endif
                                </td>
                                <td>
                                    @if($isBilled)
                                    {{ $order->quantity }}
                                    @else
                                    <input type="number" name="quantities[{{ $key }}]" value="{{ $order->quantity }}"
                                        class="form-control form-control-sm" min="1" required>
                                    @endif
                                </td>
                                <td>
                                    @if($isBilled)
                                    {{ number_format($order->price, 2) }}
                                    @else
                                    <input type="number" name="prices[{{ $key }}]" value="{{ $order->price }}"
                                        class="form-control form-control-sm" step="0.01" required>
                                    @endif
                                </td>
                                <td>{{ number_format($order->quantity * $order->price, 2) }}</td>
                                <td>
                                    
                                    @if($isBilled)
                                    <span class="badge bg-success">✔ Billed</span>
                                    @else
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                        data-bs-target="#editItemModal" data-order-id="{{ $order->id }}"
                                        data-type="{{ $group['type'] }}"
                                        data-current-id="{{ $order->{$group['type'] . '_id'} }}">
                                        Edit Item
                                    </button>
                                    @endif
                                </td>

                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <button class="btn btn-primary mt-3">Bill Selected Orders</button>

            </form>

            @if($invoice)
            <div class="mt-4">
                <h5>Active Invoice: #{{ $invoice->id }}</h5>
                <a href="{{ route('billing.invoices.show', $invoice->id) }}" class="btn btn-info">View Invoice</a>
            </div>
            @endif
        

        </div>
    </div>
</div>

<!-- Edit Item Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="editItemForm">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Order Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="order_id" id="edit-order-id">
                    <input type="hidden" name="type" id="edit-type">

                    <div class="mb-3">
                        <label for="edit-item-select" class="form-label">Select New Item</label>
                        <select name="item_id" id="edit-item-select" class="form-select select2" required>
                            {{-- dynamically loaded via JS --}}
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Add Order Modal -->
<div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="addOrderForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Order Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="visit_id" id="add-visit-id" value="{{ $visit->id }}">
                    <input type="hidden" name="type" id="add-type">

                    <div class="mb-3">
                        <label for="add-item-select" class="form-label">Select Item</label>
                        <select name="item_id" id="add-item-select" class="form-select select2" required></select>
                    </div>

                    <div class="mb-3">
                        <label for="add-quantity" class="form-label">Quantity</label>
                        <input type="disable" name="quantity" id="add-quantity" class="form-control" value="1" min="1"
                            required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Add Item</button>
                </div>
            </div>
        </form>
    </div>
</div>


@push('scripts')
<script>
    //
 
        document.addEventListener('DOMContentLoaded', function () {
            const addModal = document.getElementById('addOrderModal');

            addModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const type = button.getAttribute('data-type');

                const form = document.getElementById('addOrderForm');
                form.action = `/orders/${type}/add`;

                document.getElementById('add-type').value = type;

                // Fetch item list
                fetch(`/orders/${type}/items`)
                    .then(res => res.json())
                    .then(data => {
                        const select = document.getElementById('add-item-select');
                        select.innerHTML = '';
                        data.forEach(item => {
                            const opt = document.createElement('option');
                            opt.value = item.id;
                            opt.text = `${item.name} - KES ${item.price}`;
                            select.appendChild(opt);
                        });
                        $('.select2').select2({
                            dropdownParent: $('#addOrderModal')
                        });
                    });
            });
        });



//
document.addEventListener('DOMContentLoaded', function () {
const modal = document.getElementById('editItemModal');

modal.addEventListener('show.bs.modal', function (event) {
const button = event.relatedTarget;
const orderId = button.getAttribute('data-order-id');
const type = button.getAttribute('data-type');
const currentId = button.getAttribute('data-current-id');

document.getElementById('edit-order-id').value = orderId;
document.getElementById('edit-type').value = type;

const form = document.getElementById('editItemForm');
form.action = `/orders/${type}/${orderId}/update-item`;

fetch(`/orders/${type}/items`)
.then(res => res.json())
.then(data => {
const select = document.getElementById('edit-item-select');
select.innerHTML = '';
data.forEach(item => {
const option = document.createElement('option');
option.value = item.id;
option.text = `${item.name} - KES ${item.price}`;
if (item.id == currentId) option.selected = true;
select.appendChild(option);
});
$('.select2').select2({ dropdownParent: $('#editItemModal') });
});
});
});
</script>


@endpush
@endsection
