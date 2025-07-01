
@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0 text-white">Lab Tests</h4>
            <a href="{{ route('lab-tests.create') }}" class="btn btn-light btn-sm">Add Lab Test</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Account</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($labTests as $labTest)
                        <tr>
                            <td>{{ $labTest->name }}</td>
                            <td>{{ number_format($labTest->price, 2) }}</td>
                            <td>{{ $labTest->description }}</td>
                            <td>{{ $labTest->account->name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('lab-tests.edit', $labTest) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('lab-tests.destroy', $labTest) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this lab test?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $labTests->links() }}
            </div>
        </div>
    </div>
</div>
@endsection