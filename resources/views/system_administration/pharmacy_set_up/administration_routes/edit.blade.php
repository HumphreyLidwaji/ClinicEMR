
@extends('layouts.app')
@section('title', 'Edit Route')
@section('content')
<div class="container py-4">
    <form method="POST" action="{{ route('routes.update', $route) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Route Name</label>
            <input type="text" name="name" class="form-control" value="{{ $route->name }}" required>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection