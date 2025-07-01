
@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="mb-4">Add Store Location</h1>
    <form method="POST" action="{{ route('store-locations.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Location Name</label>
            <input name="name" type="text" class="form-control" required value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Type</label>
            <input name="type" type="text" class="form-control" required value="{{ old('type') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Managed By</label>
            <input name="manager_name" type="text" class="form-control" value="{{ old('manager_name') }}">
        </div>
        <button class="btn btn-success">Save Location</button>
        <a href="{{ route('store-locations.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection