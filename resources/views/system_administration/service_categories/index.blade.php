@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Service Categories</h1>

    <a href="{{ route('service-categories.create') }}" class="btn btn-success mb-3">Add Service Category</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Description</th>
                <th width="150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cat)
            <tr>
                <td>{{ $cat->name }}</td>
                <td>{{ $cat->description }}</td>
                <td>
                    <a href="{{ route('service-categories.edit', $cat->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('service-categories.destroy', $cat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
