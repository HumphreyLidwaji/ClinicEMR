@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Systematic Examinations</h4>
    <a href="{{ route('systematic-examinations.create') }}" class="btn btn-sm btn-success mb-3">Add New</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>System</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $examination)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $examination->name }}</td>
                <td>{{ $examination->system }}</td>
                <td>
                    <a href="{{ route('systematic-examinations.edit', $examination->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('systematic-examinations.destroy', $examination->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
