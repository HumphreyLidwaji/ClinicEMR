@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Banks</h1>
    <a href="{{ route('banks.create') }}" class="btn btn-success mb-3">Add Bank</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Bank Name</th>
                <th>Swift Code</th>
                <th>Description</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($banks as $bank)
            <tr>
                <td>{{ $bank->name }}</td>
                <td>{{ $bank->swift_code ?? '-' }}</td>
                <td>{{ $bank->description ?? '-' }}</td>
                <td>
                    <a href="{{ route('banks.edit', $bank->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('banks.destroy', $bank->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this bank?')">
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
