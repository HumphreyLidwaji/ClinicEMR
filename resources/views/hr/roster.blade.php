@extends('layouts.app')
@section('title', 'Employee Roster')

@section('content')
<div class="container">
    <h4 class="mb-4">Roster</h4>
    <a href="{{ route('hr.rosters.create') }}" class="btn btn-primary mb-3">Assign Roster</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Date</th>
                <th>Shift</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rosters as $roster)
            <tr>
                <td>{{ $roster->employee->name }}</td>
                <td>{{ $roster->date }}</td>
                <td>{{ $roster->shift }}</td>
                <td>{{ $roster->notes }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
