@extends('layouts.app')

@section('title', isset($store) ? 'Edit Store' : 'Add Store')

@section('content')
<div class="container">
    <h4 class="mb-4">{{ isset($store) ? 'Edit' : 'Add' }} Store</h4>

    <form action="{{ isset($store) ? route('stores.update', $store) : route('stores.store') }}" method="POST">
        @csrf
        @if(isset($store)) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">Store Name</label>
            <input type="text" name="name" value="{{ old('name', $store->name ?? '') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" value="{{ old('location', $store->location ?? '') }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($store) ? 'Update' : 'Save' }}</button>
        <a href="{{ route('stores.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
