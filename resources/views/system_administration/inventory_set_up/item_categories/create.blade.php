
@extends('layouts.app')
@section('title', 'Add Category')

@section('content')
<div class="container">
    <h4 class="mb-4">Add Category</h4>
    <form method="POST" action="{{ route('inventory.categories.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input name="name" type="text" class="form-control" required value="{{ old('name') }}">
        </div>
        <button class="btn btn-success">Save Category</button>
        <a href="{{ route('inventory.categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection