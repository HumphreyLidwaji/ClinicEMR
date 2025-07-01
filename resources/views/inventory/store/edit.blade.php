
@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="mb-4">Edit Store Location</h1>
    <form method="POST" action="{{ route('store-locations.update', $location->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Location Name</label>
            <input name="name" type="text" class="form-control" required value="{{ old('name', $location->name) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Type</label>
            <input name="type" type="text" class="form-control" required value="{{ old('type', $location->type) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Managed By</label>
            <input name="manager_name" type="text" class="form-control" value="{{ old('manager_name', $location->manager_name) }}">
        </div>
        <button class="btn btn-primary">Update Location</button>
        <a href="{{ route('store-locations.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection