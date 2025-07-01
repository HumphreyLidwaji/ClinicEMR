
@extends('layouts.app')
@section('title', 'Edit Dosage')
@section('content')
<div class="container py-4">
    <form method="POST" action="{{ route('dosages.update', $dosage) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Dosage Description</label>
            <input type="text" name="description" class="form-control" value="{{ $dosage->description }}" required>
        </div>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection