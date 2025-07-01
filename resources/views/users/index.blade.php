@extends('layouts.app')

@section('content')
<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>There were some problems with your input:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <h4>Users</h4>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add New User</a>

    <table class="table table-bordered">
        <thead><tr><th>Name</th><th>Email</th><th>Employee</th><th>Roles</th><th>Action</th></tr></thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->employee->name ?? 'N/A' }}</td>
                <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                <td>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form method="POST" action="{{ route('users.destroy', $user) }}" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete user?')">Delete</button>
                    </form>
                    <a href="{{ route('users.security', $user) }}" class="btn btn-sm btn-secondary">Security</a>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
