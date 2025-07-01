@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Reorder Levels</h1>
    <a href="{{ route('reorder-levels.create') }}" class="btn btn-success mb-3">Set Reorder Level</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Item</th>
                <th>Store</th>
                <th>Reorder Quantity</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reorders as $reorder)
            <tr>
                <td>{{ $reorder->item->name }}</td>
                <td>{{ $reorder->store->name }}</td>
                <td>{{ $reorder->quantity }}</td>
                <td>
                    <a href="{{ route('reorder-levels.edit', $reorder->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('reorder-levels.destroy', $reorder->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this entry?')">
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
