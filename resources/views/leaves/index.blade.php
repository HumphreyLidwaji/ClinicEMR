@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Leave Requests</h4>
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>There were some problems with your input:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    <a href="{{ route('leaves.create') }}" class="btn btn-primary mb-3">Apply for Leave</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Employee</th><th>Type</th><th>Dates</th><th>Status</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($leaves as $leave)
            <tr>
                <td>{{ $leave->employee->first_name }} {{ $leave->employee->last_name }}</td>
                <td>{{ $leave->leave_type }}</td>
                <td>{{ $leave->start_date }} to {{ $leave->end_date }}</td>
                <td>
                    <span class="badge bg-{{ $leave->status == 'approved' ? 'success' : ($leave->status == 'rejected' ? 'danger' : 'warning') }}">
                        {{ ucfirst($leave->status) }}
                    </span>
                </td>
                <td>
                    @if($leave->status == 'pending')
                        <form action="{{ route('leaves.approve', $leave) }}" method="POST" class="d-inline">
                            @csrf <button class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form action="{{ route('leaves.reject', $leave) }}" method="POST" class="d-inline">
                            @csrf <button class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    @else
                        <small>By {{ optional($leave->approver)->name }} at {{ $leave->approved_at }}</small>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
