@extends('layouts.app')
@section('title', 'Goods Received Notes')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Goods Received Notes List</h4>
        <a href="{{ route('grns.create') }}" class="btn btn-primary">Create GRN</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            List of GRNs
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
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
    </div>
</div>
@endsection
