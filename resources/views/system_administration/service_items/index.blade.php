
@extends('layouts.app')
@section('title', 'Services')
@section('content')
<div class="container py-4">
    <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">Add Service</a>
    <table class="table table-bordered">
        <thead>
            <tr><th>Name</th><th>Price</th><th>Action</th></tr>
        </thead>
        <tbody>
            @foreach($services as $service)
                <tr>
                    <td>{{ $service->name }}</td>
                    <td>${{ number_format($service->price, 2) }}</td>
                    <td>
                        <a href="{{ route('services.edit', $service) }}" class="btn btn-sm btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection