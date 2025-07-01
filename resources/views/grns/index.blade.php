@extends('layouts.app')
@section('title', 'Goods Received Notes')

@section('content')
<div class="container">
    <h4 class="mb-4">GRNs</h4>
    <a href="{{ route('grns.create') }}" class="btn btn-primary mb-3">Create GRN</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>PO #</th>
                <th>Store</th>
                <th>Date</th>
                <th>Items</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($grns as $grn)
            <tr>
                <td>#{{ $grn->purchaseOrder->id ?? '-' }}</td>
                <td>{{ $grn->store->name }}</td>
                <td>{{ $grn->received_date ?? $grn->created_at->toDateString() }}</td>
                <td>{{ $grn->items->count() }}</td>
                <td>
                    <a href="{{ route('grns.show', $grn) }}" class="btn btn-sm btn-success">View</a>
                    <form action="{{ route('grns.destroy', $grn) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this GRN?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
