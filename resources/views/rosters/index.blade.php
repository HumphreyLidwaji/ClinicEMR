@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Duty Roster</h4>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    <a href="{{ route('rosters.create') }}" class="btn btn-primary mb-3">Assign Shift</a>

    <table class="table table-bordered">
        <thead>
            <tr><th>Date</th><th>Employee</th><th>Shift</th><th>Actions</th></tr>
        </thead>
        <tbody>
        @foreach($rosters as $roster)
            <tr>
                <td>{{ $roster->shift_date }}</td>
                <td>{{ $roster->employee->first_name }} {{ $roster->employee->last_name }}</td>
                <td>{{ $roster->shift }}</td>
                <td>
                    <a href="{{ route('rosters.edit', $roster) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('rosters.destroy', $roster) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this shift?')">
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
