@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Visit Types</h1>

    <a href="{{ route('visit-types.create') }}" class="btn btn-success mb-3">Add Visit Type</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Default Fee</th>
                <th width="150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visitTypes as $type)
            <tr>
                <td>{{ $type->name }}</td>
                <td>{{ $type->code }}</td>
                <td>{{ number_format($type->default_fee, 2) }}</td>
                <td>
                    <a href="{{ route('visit-types.edit', $type->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('visit-types.destroy', $type->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this type?')">
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
