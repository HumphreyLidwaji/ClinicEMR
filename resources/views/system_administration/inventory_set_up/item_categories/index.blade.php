
@extends('layouts.app')
@section('title', 'Item Categories')

@section('content')
<div class="container">
    <h4 class="mb-4">Categories</h4>
    <a href="{{ route('inventory.categories.create') }}" class="btn btn-primary mb-3">Add Category</a>
    <table class="table table-bordered">
        <thead>
            <tr><th>Name</th><th>Action</th></tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('inventory.categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection