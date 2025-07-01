@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lab Test Groups</h1>

    <a href="{{ route('lab-test-groups.create') }}" class="btn btn-success mb-3">Add Test Group</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Group Name</th>
                <th>Tests Included</th>
                <th width="150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($labTestGroups as $group)
            <tr>
                <td>{{ $group->name }}</td>
                <td>
                    @foreach($group->tests as $test)
                        <span class="badge bg-secondary">{{ $test->name }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('lab-test-groups.edit', $group->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('lab-test-groups.destroy', $group->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this group?')">
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
