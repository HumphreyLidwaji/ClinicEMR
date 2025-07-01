@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Clinical Diagnoses</h4>
    <a href="{{ route('clinical-diagnoses.create') }}" class="btn btn-success mb-3">Add New Diagnosis</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $diagnosis)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $diagnosis->name }}</td>
                <td>{{ $diagnosis->category ?? '-' }}</td>
                <td>
                    <a href="{{ route('clinical-diagnoses.edit', $diagnosis->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('clinical-diagnoses.destroy', $diagnosis->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this diagnosis?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No diagnoses found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
