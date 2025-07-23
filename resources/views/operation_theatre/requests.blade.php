@extends('layouts.app')

@section('content')
<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <span>Surgery Requests List</span>
            <a href="{{ route('surgery.requests.create') }}" class="btn btn-light btn-sm">Create New Request</a>
        </div>
        <div class="card-body p-0">
            @if($requests->isEmpty())
                <p class="p-3 mb-0">No surgery requests found.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0 align-middle">
                        <thead class="">
                            <tr>
                                <th>Patient Name</th>
                                <th>Surgery Type</th>
                                <th>Status</th>
                                <th>Requested At</th>
                                <th class="text-center" style="width: 140px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $request)
                            <tr>
                                <td>{{ $request->patient_name }}</td>
                                <td>{{ $request->surgery_type }}</td>
                                <td>{{ ucfirst($request->status) }}</td>
                                <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('surgery.requests.show', $request->id) }}" class="btn btn-sm btn-success me-1" title="View Details">
                                        View
                                    </a>
                                    <form action="{{ route('surgery.requests.destroy', $request->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this request?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" title="Delete Request">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
