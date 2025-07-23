@extends('layouts.app')

@section('content')
<div class="container mt-4">
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

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <a href="{{ route('leaves.create') }}" class="btn btn-primary mb-3">Apply for Leave</a>

    <div class="card">
        <div class="card-header bg-success text-white">
            Leave Requests
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Employee</th>
                            <th>Type</th>
                            <th>Dates</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($leaves as $leave)
                        <tr>
                            <td>{{ $leave->employee->first_name }} {{ $leave->employee->last_name }}</td>
                            <td>{{ $leave->leave_type }}</td>
                            <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('M d, Y') }} to {{ \Carbon\Carbon::parse($leave->end_date)->format('M d, Y') }}</td>
                            <td>
                                <span class="badge bg-{{ $leave->status == 'approved' ? 'success' : ($leave->status == 'rejected' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($leave->status) }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($leave->status === 'pending')
                                    <form action="{{ route('leaves.approve', $leave) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-success btn-sm" type="submit">Approve</button>
                                    </form>
                                    <form action="{{ route('leaves.reject', $leave) }}" method="POST" class="d-inline ms-1">
                                        @csrf
                                        <button class="btn btn-danger btn-sm" type="submit">Reject</button>
                                    </form>
                                @else
                                    <small>
                                        By {{ optional($leave->approver)->name ?? 'N/A' }}<br>
                                        <time datetime="{{ $leave->approved_at }}">{{ $leave->approved_at ? \Carbon\Carbon::parse($leave->approved_at)->format('M d, Y h:i A') : '' }}</time>
                                    </small>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No leave requests found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
