@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Patient Categories</h1>

    <a href="{{ route('patient-categories.create') }}" class="btn btn-success mb-3">Add Patient Category</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th width="150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <a href="{{ route('patient-categories.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('patient-categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?')">
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
