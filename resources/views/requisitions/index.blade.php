@extends('layouts.app')

@section('title', 'Requisitions')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Requisitions</h5>
            <a href="{{ route('requisitions.create') }}" class="btn btn-light btn-sm">New Requisition</a>
        </div>

        <div class="card-body p-0">
            @if($requisitions->count())
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Store</th>
                            <th>Status</th>
                            <th>Requested By</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requisitions as $req)
                        <tr>
                            <td>{{ $req->id }}</td>
                            <td>{{ $req->store->name }}</td>
                            <td>
                                <span class="badge {{ $req->status == 'pending' ? 'bg-warning text-dark' : 'bg-info' }}">
                                    {{ ucfirst($req->status) }}
                                </span>
                            </td>
                            <td>{{ $req->requestedBy->name ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('requisitions.show', $req->id) }}" class="btn btn-sm btn-info">View</a>

                                <form method="POST" action="{{ route('requisitions.destroy', $req->id) }}" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this requisition?')">Delete</button>
                                </form>

                                @if($req->status == 'pending')
                                <form method="POST" action="{{ route('requisitions.approve', $req->id) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success">Approve</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <div class="p-3">
                    <p class="mb-0">No requisitions found.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
