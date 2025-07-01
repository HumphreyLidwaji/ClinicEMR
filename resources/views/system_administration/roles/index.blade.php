@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Role Management</h1>
    <a href="{{ route('roles.create') }}" class="btn btn-success mb-3">Create Role</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Permissions</th>
                <th width="180px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>
                    @foreach($role->permissions as $perm)
                        <span class="badge bg-info">{{ $perm->name }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Delete this role?')">
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
