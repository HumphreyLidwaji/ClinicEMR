@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Department</h2>
        @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('departments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Department Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (optional)</label>
            <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
