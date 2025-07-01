@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Nationalities</h1>

    <a href="{{ route('nationalities.create') }}" class="btn btn-success mb-3">Add Nationality</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Country</th>
                <th>Nationality</th>
                <th width="150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nationalities as $nat)
            <tr>
                <td>{{ $nat->country }}</td>
                <td>{{ $nat->nationality }}</td>
                <td>
                    <a href="{{ route('nationalities.edit', $nat->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('nationalities.destroy', $nat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this nationality?')">
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
