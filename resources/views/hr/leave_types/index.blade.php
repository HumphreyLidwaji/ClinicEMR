@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Leave Types</h2>
    <a href="{{ route('leave-types.create') }}" class="btn btn-primary mb-3">Add Leave Type</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leaveTypes as $leaveType)
                <tr>
                    <td>{{ $leaveType->name }}</td>
                    <td>{{ $leaveType->description }}</td>
                    <td class="text-end">
                        <a href="{{ route('leave-types.edit', $leaveType) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('leave-types.destroy', $leaveType) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
