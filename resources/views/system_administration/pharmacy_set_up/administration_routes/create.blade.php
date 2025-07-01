
@extends('layouts.app')
@section('title', 'Add Route')
@section('content')
<div class="container py-4">
    <form method="POST" action="{{ route('routes.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Route Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection