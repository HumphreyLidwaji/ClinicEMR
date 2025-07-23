@extends('layouts.app')

@section('title', isset($store) ? 'Edit Store' : 'Add Store')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">{{ isset($store) ? 'Edit' : 'Add' }} Store</h5>
        </div>

        <div class="card-body">
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

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($store) ? 'Update' : 'Save' }}
                    </button>
                    <a href="{{ route('stores.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
