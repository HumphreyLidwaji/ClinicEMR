@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Vendors</h1>
    <a href="{{ route('vendors.create') }}" class="btn btn-success mb-3">Add Vendor</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Contact Person</th>
                <th>Phone</th>
                <th>Email</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vendors as $vendor)
            <tr>
                <td>{{ $vendor->name }}</td>
                <td>{{ $vendor->contact_person }}</td>
                <td>{{ $vendor->phone }}</td>
                <td>{{ $vendor->email }}</td>
                <td>
                    <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this vendor?')">
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
