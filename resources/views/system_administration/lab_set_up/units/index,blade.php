@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Units of Measurement</h1>

    <a href="{{ route('units.create') }}" class="btn btn-success mb-3">Add Unit</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Unit Name</th>
                <th>Symbol</th>
                <th width="150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($units as $unit)
            <tr>
                <td>{{ $unit->name }}</td>
                <td>{{ $unit->symbol }}</td>
                <td>
                    <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('units.destroy', $unit->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this unit?')">
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
