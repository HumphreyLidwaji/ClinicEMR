@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Departments</h2>
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
    <a href="{{ route('departments.create') }}" class="btn btn-primary">Add Department</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $department)
            <tr>
                <td>{{ $department->name }}</td>
                <td>{{ $department->description }}</td>
                <td>
                    <a href="{{ route('departments.edit', $department) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('departments.destroy', $department) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this department?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
