@extends('layouts.app')
@section('title', 'Requisitions')

@section('content')
<div class="container">
    <h4 class="mb-4">Requisitions</h4>

    <a href="{{ route('requisitions.create') }}" class="btn btn-primary mb-3">New Requisition</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th><th>Store</th><th>Status</th><th>Requested By</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requisitions as $req)
            <tr>
                <td>{{ $req->id }}</td>
                <td>{{ $req->store->name }}</td>
                <td><span class="badge bg-info">{{ $req->status }}</span></td>
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
@endsection
