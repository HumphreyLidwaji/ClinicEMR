@extends('layouts.app')
@section('title', 'Requisition Details')

@section('content')
<div class="container">
    <h4 class="mb-4">Requisition #{{ $requisition->id }}</h4>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Store:</strong> {{ $requisition->store->name }}</p>
            <p><strong>Status:</strong> <span class="badge bg-info">{{ $requisition->status }}</span></p>
            <p><strong>Requested By:</strong> {{ $requisition->requestedBy->name ?? 'N/A' }}</p>
            <p><strong>Approved By:</strong> {{ $requisition->approvedBy->name ?? 'Not yet approved' }}</p>
            <p><strong>Notes:</strong> {{ $requisition->notes }}</p>
        </div>
    </div>

    <h5>Items Requested</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Item</th><th>Quantity</th><th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requisition->items as $ri)
            <tr>
                <td>{{ $ri->item->name ?? '-' }}</td>
                <td>{{ $ri->quantity }}</td>
                <td>{{ $ri->remarks }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
