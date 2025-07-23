@extends('layouts.app')

@section('title', 'Inventory Items')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Inventory Items</h5>
            <a href="{{ route('items.create') }}" class="btn btn-light btn-sm">Add Item</a>
        </div>

        <div class="card-body">
            @if($items->count())
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Category</th>
                            <th>Reorder Level</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->category?->name ?? '-' }}</td>
                            <td>{{ $item->reorder_level }}</td>
                            <td>
                                <span class="badge {{ $item->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $item->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('items.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('items.destroy', $item) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this item?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="mb-0">No inventory items found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
