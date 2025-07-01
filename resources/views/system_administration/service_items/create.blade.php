
@extends('layouts.app')
@section('title', 'Add Service')
@section('content')
<div class="container py-4">
    <form method="POST" action="{{ route('services.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Service Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" name="price" class="form-control" step="0.01" required>
        </div>
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection