@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">User Management</h1>
    <a href="{{ route('users.create') }}" class="btn btn-success mb-3">Create New User</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th width="180px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name ?? 'N/A' }}</td>
                <td>{{ $user->is_active ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Are you sure?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
