@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Surgery Requests</h2>

    <a href="{{ route('surgery.requests.create') }}" class="btn btn-primary mb-3">Create New Request</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($requests->isEmpty())
        <p>No surgery requests found.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Surgery Type</th>
                    <th>Status</th>
                    <th>Requested At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($requests as $request)
                <tr>
                    <td>{{ $request->patient_name }}</td>
                    <td>{{ $request->surgery_type }}</td>
                    <td>{{ ucfirst($request->status) }}</td>
                    <td>{{ $request->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('surgery.requests.show', $request->id) }}" class="btn btn-info btn-sm">View</a>
                        <form action="{{ route('surgery.requests.destroy', $request->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
