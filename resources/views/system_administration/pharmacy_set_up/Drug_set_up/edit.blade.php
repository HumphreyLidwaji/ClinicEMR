
@extends('layouts.app')
@section('title', 'Edit Drug')
@section('content')
<div class="container py-4">
    <form method="POST" action="{{ route('drugs.update', $drug) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Drug Name</label>
            <input type="text" name="name" class="form-control" value="{{ $drug->name }}" required>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection