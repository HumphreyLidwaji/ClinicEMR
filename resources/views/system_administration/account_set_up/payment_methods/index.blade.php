@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Payment Methods</h1>
    <a href="{{ route('payment-methods.create') }}" class="btn btn-success mb-3">Add Payment Method</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Method Name</th>
                <th>Description</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($methods as $method)
            <tr>
                <td>{{ $method->name }}</td>
                <td>{{ $method->description ?? '-' }}</td>
                <td>
                    <a href="{{ route('payment-methods.edit', $method->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('payment-methods.destroy', $method->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this method?')">
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
