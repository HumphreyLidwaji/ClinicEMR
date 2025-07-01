
@extends('layouts.app')
@section('title', 'Edit Service')
@section('content')
<div class="container py-4">
    <form method="POST" action="{{ route('services.update', $service) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Service Name</label>
            <input type="text" name="name" class="form-control" value="{{ $service->name }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" name="price" class="form-control" step="0.01" value="{{ $service->price }}" required>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection