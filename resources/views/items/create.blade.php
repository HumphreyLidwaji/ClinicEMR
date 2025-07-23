@extends('layouts.app')

@section('title', isset($item) ? 'Edit Item' : 'Add Item')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">{{ isset($item) ? 'Edit' : 'Add' }} Inventory Item</h5>
        </div>
        <div class="card-body">
            <form action="{{ isset($item) ? route('items.update', $item) : route('items.store') }}" method="POST">
                @csrf
                @if(isset($item))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Unit</label>
                    <input type="text" name="unit" value="{{ old('unit', $item->unit ?? '') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">-- Select --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ (old('category_id', $item->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Reorder Level</label>
                    <input type="number" name="reorder_level" value="{{ old('reorder_level', $item->reorder_level ?? 0) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="is_active" class="form-control">
                        <option value="1" {{ (old('is_active', $item->is_active ?? 1) == 1) ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ (old('is_active', $item->is_active ?? 1) == 0) ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">{{ isset($item) ? 'Update' : 'Save' }}</button>
                    <a href="{{ route('items.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
