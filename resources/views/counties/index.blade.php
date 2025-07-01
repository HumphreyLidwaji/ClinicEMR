@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Counties</h2>
        <a href="{{ route('counties.create') }}" class="btn btn-primary">Add County</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>County Name</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($counties as $county)
                    <tr>
                        <td>{{ $county->id }}</td>
                        <td>{{ $county->county_name }}</td>
                        <td class="text-center">
                            <a href="{{ route('counties.edit', $county->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                            <form action="{{ route('counties.destroy', $county->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this county?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">No counties found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
