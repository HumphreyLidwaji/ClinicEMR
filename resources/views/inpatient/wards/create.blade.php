
@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h4>Add Ward</h4>
    <form action="{{ route('wards.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Ward Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection