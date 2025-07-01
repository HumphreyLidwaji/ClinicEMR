@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Deductions</h4>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    <a href="{{ route('deductions.create') }}" class="btn btn-primary mb-3">Add Deduction Rule</a>

    <table class="table table-bordered">
        <thead>
            <tr><th>Name</th><th>Type</th><th>Value</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($deductions as $d)
                <tr>
                    <td>{{ $d->name }}</td>
                    <td>{{ ucfirst($d->type) }}</td>
                    <td>{{ $d->display_value }}</td>
                    <td>
                        @if($d->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('deductions.edit', $d) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('deductions.destroy', $d) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this deduction?')">
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
