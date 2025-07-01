@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Permission Management</h1>
    <a href="{{ route('permissions.create') }}" class="btn btn-success mb-3">Add Permission</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Guard</th>
                <th width="150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
            <tr>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->guard_name }}</td>
                <td>
                    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Delete this permission?')">
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

