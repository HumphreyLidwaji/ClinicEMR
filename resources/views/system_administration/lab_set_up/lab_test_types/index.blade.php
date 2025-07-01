@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lab Test Types</h1>

    <a href="{{ route('lab-test-types.create') }}" class="btn btn-success mb-3">Add Test Type</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Test Name</th>
                <th>Code</th>
                <th>Description</th>
                <th width="150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($labTestTypes as $test)
            <tr>
                <td>{{ $test->name }}</td>
                <td>{{ $test->code }}</td>
                <td>{{ $test->description }}</td>
                <td>
                    <a href="{{ route('lab-test-types.edit', $test->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('lab-test-types.destroy', $test->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this test type?')">
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
