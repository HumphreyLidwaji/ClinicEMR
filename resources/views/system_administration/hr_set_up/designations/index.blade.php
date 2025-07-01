@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Designations</h1>

    <a href="{{ route('designations.create') }}" class="btn btn-success mb-3">Add Designation</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Department</th>
                <th width="150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($designations as $designation)
            <tr>
                <td>{{ $designation->title }}</td>
                <td>{{ $designation->department->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('designations.edit', $designation->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('designations.destroy', $designation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this designation?')">
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
