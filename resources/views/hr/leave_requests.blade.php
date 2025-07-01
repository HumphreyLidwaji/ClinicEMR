@extends('layouts.app')
@section('title', 'Leave Requests')

@section('content')
<div class="container">
    <h4 class="mb-4">Leave Requests</h4>
    <a href="{{ route('hr.leaves.create') }}" class="btn btn-primary mb-3">New Leave Request</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Type</th>
                <th>From</th>
                <th>To</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leaves as $leave)
            <tr>
                <td>{{ $leave->employee->name }}</td>
                <td>{{ $leave->type }}</td>
                <td>{{ $leave->start_date }}</td>
                <td>{{ $leave->end_date }}</td>
                <td>{{ ucfirst($leave->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
