@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Pharmacy Locations</h1>
    <a href="{{ route('pharmacy-locations.create') }}" class="btn btn-success mb-3">Add Location</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Location Name</th>
                <th>Type</th>
                <th>Description</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($locations as $location)
            <tr>
                <td>{{ $location->name }}</td>
                <td>{{ $location->type }}</td>
                <td>{{ $location->description ?? '-' }}</td>
                <td>
                    <a href="{{ route('pharmacy-locations.edit', $location->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('pharmacy-locations.destroy', $location->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this location?')">
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
