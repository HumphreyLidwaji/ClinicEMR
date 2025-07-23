@extends('layouts.app')

@section('title', 'Stores')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Inventory Stores</h5>
            <a href="{{ route('stores.create') }}" class="btn btn-light btn-sm">Add Store</a>
        </div>

        <div class="card-body p-0">
            @if($stores->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Store Name</th>
                                <th>Location</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stores as $store)
                                <tr>
                                    <td>{{ $store->name }}</td>
                                    <td>{{ $store->location }}</td>
                                    <td>
                                        <a href="{{ route('stores.edit', $store) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('stores.destroy', $store) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this store?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-3">
                    <p class="mb-0">No stores available.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
