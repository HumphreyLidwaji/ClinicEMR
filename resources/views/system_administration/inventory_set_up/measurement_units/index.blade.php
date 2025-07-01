@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Measurement Units</h1>
    <a href="{{ route('measurement-units.create') }}" class="btn btn-success mb-3">Add Unit</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Unit Name</th>
                <th>Abbreviation</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($units as $unit)
            <tr>
                <td>{{ $unit->name }}</td>
                <td>{{ $unit->abbreviation }}</td>
                <td>
                    <a href="{{ route('measurement-units.edit', $unit->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('measurement-units.destroy', $unit->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this unit?')">
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
