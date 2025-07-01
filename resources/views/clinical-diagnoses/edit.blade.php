@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Clinical Diagnosis</h4>

    <form action="{{ route('clinical-diagnoses.update', $item->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Diagnosis Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $item->name) }}">
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Category (optional)</label>
            <input type="text" name="category" class="form-control" value="{{ old('category', $item->category) }}">
            @error('category') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('clinical-diagnoses.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
