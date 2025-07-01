
@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="mb-4">Add Vendor</h1>
    <form method="POST" action="{{ route('vendors.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input name="name" type="text" class="form-control" required value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Contact Person</label>
            <input name="contact_person" type="text" class="form-control" value="{{ old('contact_person') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input name="phone" type="text" class="form-control" value="{{ old('phone') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input name="email" type="email" class="form-control" value="{{ old('email') }}">
        </div>
        <button class="btn btn-success">Save Vendor</button>
        <a href="{{ route('vendors.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection