@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tax Types</h1>
    <a href="{{ route('tax-types.create') }}" class="btn btn-success mb-3">Add Tax Type</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tax Name</th>
                <th>Rate (%)</th>
                <th>Description</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($taxes as $tax)
            <tr>
                <td>{{ $tax->name }}</td>
                <td>{{ $tax->rate }}</td>
                <td>{{ $tax->description ?? '-' }}</td>
                <td>
                    <a href="{{ route('tax-types.edit', $tax->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('tax-types.destroy', $tax->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this tax?')">
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
