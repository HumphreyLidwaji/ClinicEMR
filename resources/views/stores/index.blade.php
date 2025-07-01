@extends('layouts.app')

@section('title', 'Stores')

@section('content')
<div class="container">
    <h4 class="mb-4">Inventory Stores</h4>
    <a href="{{ route('stores.create') }}" class="btn btn-primary mb-3">Add Store</a>

    <table class="table table-bordered table-striped">
        <thead>
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
@endsection
