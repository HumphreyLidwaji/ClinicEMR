
@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="mb-4">Edit Vendor</h1>
    <form method="POST" action="{{ route('vendors.update', $vendor->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" type="text" class="form-control" required value="{{ old('name', $vendor->name) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Contact Person</label>
            <input name="contact_person" type="text" class="form-control" value="{{ old('contact_person', $vendor->contact_person) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input name="phone" type="text" class="form-control" value="{{ old('phone', $vendor->phone) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" value="{{ old('email', $vendor->email) }}">
        </div>
        <button class="btn btn-primary">Update Vendor</button>
        <a href="{{ route('vendors.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection