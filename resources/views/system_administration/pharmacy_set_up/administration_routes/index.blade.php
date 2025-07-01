
@extends('layouts.app')
@section('title', 'Routes')
@section('content')
<div class="container py-4">
    <a href="{{ route('routes.create') }}" class="btn btn-primary mb-3">Add Route</a>
    <table class="table table-bordered">
        <thead><tr><th>Name</th><th>Action</th></tr></thead>
        <tbody>
            @foreach($routes as $route)
                <tr>
                    <td>{{ $route->name }}</td>
                    <td>
                        <a href="{{ route('routes.edit', $route) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection