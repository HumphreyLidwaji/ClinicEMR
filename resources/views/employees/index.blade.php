@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Employee List</h4>
    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Add Employee</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th><th>Position</th><th>Phone</th><th>Email</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($employees as $employee)
            <tr>
                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                <td>{{ $employee->position }}</td>
                <td>{{ $employee->phone_number }}</td>
                <td>{{ $employee->email }}</td>
                <td>
                    <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Delete this employee?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5">No employees found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $employees->links() }}
</div>
@endsection
