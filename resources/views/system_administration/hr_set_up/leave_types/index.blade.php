@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Leave Types</h1>

    <a href="{{ route('leave-types.create') }}" class="btn btn-success mb-3">Add Leave Type</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Type</th>
                <th>Number of Days</th>
                <th>Carry Forward</th>
                <th width="150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leaveTypes as $leave)
            <tr>
                <td>{{ $leave->name }}</td>
                <td>{{ $leave->days }}</td>
                <td>{{ $leave->carry_forward ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('leave-types.edit', $leave->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('leave-types.destroy', $leave->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this leave type?')">
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
