
@extends('layouts.app')
@section('title', 'Add Dosage')
@section('content')
<div class="container py-4">
    <form method="POST" action="{{ route('dosages.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Dosage Description</label>
            <input type="text" name="description" class="form-control" required>
        </div>
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection