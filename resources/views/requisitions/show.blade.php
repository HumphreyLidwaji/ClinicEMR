@extends('layouts.app')

@section('title', 'Requisition Details')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Requisition #{{ $requisition->id }}</h5>
        </div>

        <div class="card-body">
            <p><strong>Store:</strong> {{ $requisition->store->name }}</p>
            <p><strong>Status:</strong> 
                <span class="badge {{ $requisition->status == 'pending' ? 'bg-warning text-dark' : 'bg-info' }}">
                    {{ ucfirst($requisition->status) }}
                </span>
            </p>
            <p><strong>Requested By:</strong> {{ $requisition->requestedBy->name ?? 'N/A' }}</p>
            <p><strong>Approved By:</strong> {{ $requisition->approvedBy->name ?? 'Not yet approved' }}</p>
            <p><strong>Notes:</strong> {{ $requisition->notes ?? '—' }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-light">
            <h6 class="mb-0">Items Requested</h6>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requisition->items as $ri)
                    <tr>
                        <td>{{ $ri->item->name ?? '-' }}</td>
                        <td>{{ $ri->quantity }}</td>
                        <td>{{ $ri->remarks ?? '—' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
