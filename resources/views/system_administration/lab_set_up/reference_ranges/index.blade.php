@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Reference Ranges</h1>

    <a href="{{ route('reference-ranges.create') }}" class="btn btn-success mb-3">Add Reference Range</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Test</th>
                <th>Gender</th>
                <th>Age Range</th>
                <th>Normal Min</th>
                <th>Normal Max</th>
                <th>Unit</th>
                <th width="150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($referenceRanges as $ref)
            <tr>
                <td>{{ $ref->labTest->name ?? '-' }}</td>
                <td>{{ ucfirst($ref->gender) }}</td>
                <td>{{ $ref->age_min }} - {{ $ref->age_max }} yrs</td>
                <td>{{ $ref->normal_min }}</td>
                <td>{{ $ref->normal_max }}</td>
                <td>{{ $ref->unit->symbol ?? '-' }}</td>
                <td>
                    <a href="{{ route('reference-ranges.edit', $ref->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('reference-ranges.destroy', $ref->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this range?')">
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
