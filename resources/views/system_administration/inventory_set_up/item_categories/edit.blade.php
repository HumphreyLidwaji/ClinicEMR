
@extends('layouts.app')
@section('title', 'Edit Category')

@section('content')
<div class="container">
    <h4 class="mb-4">Edit Category</h4>
    <form method="POST" action="{{ route('inventory.categories.update', $category) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input name="name" type="text" class="form-control" required value="{{ old('name', $category->name) }}">
        </div>
        <button class="btn btn-primary">Update Category</button>
        <a href="{{ route('inventory.categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection