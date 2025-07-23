@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <span>Employee List</span>
            <a href="{{ route('employees.create') }}" class="btn btn-light btn-sm">+ Add Employee</a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th style="width: 160px;">Actions</th>
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
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No employees found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $employees->links() }}
        </div>
    </div>
</div>
@endsection
