@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Referral Sources</h1>

    <a href="{{ route('referral-sources.create') }}" class="btn btn-success mb-3">Add Referral Source</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Contact Info</th>
                <th width="150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sources as $source)
            <tr>
                <td>{{ $source->name }}</td>
                <td>{{ $source->type }}</td>
                <td>{{ $source->contact }}</td>
                <td>
                    <a href="{{ route('referral-sources.edit', $source->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('referral-sources.destroy', $source->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this source?')">
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
