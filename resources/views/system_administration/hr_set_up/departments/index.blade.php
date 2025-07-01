@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Departments</h1>

    <a href="{{ route('departments.create') }}" class="btn btn-success mb-3">Add Department</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Head of Department</th>
                <th width="150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departments as $dept)
            <tr>
                <td>{{ $dept->name }}</td>
                <td>{{ $dept->hod_name ?? '-' }}</td>
                <td>
                    <a href="{{ route('departments.edit', $dept->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('departments.destroy', $dept->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this department?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
