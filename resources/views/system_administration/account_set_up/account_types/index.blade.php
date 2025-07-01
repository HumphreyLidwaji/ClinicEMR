@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Account Types</h1>
    <a href="{{ route('account-types.create') }}" class="btn btn-success mb-3">Add Account Type</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($types as $type)
            <tr>
                <td>{{ $type->name }}</td>
                <td>{{ $type->description ?? '-' }}</td>
                <td>
                    <a href="{{ route('account-types.edit', $type->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('account-types.destroy', $type->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this type?')">
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
