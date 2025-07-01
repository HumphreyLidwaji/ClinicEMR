@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Allowances</h2>

    <a href="{{ route('allowances.create') }}" class="btn btn-primary mb-3">Add Allowance</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Amount</th>
                <th>Description</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allowances as $allowance)
                <tr>
                    <td>{{ $allowance->name }}</td>
                    <td>${{ number_format($allowance->amount, 2) }}</td>
                    <td>{{ $allowance->description }}</td>
                    <td class="text-end">
                        <a href="{{ route('allowances.edit', $allowance) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('allowances.destroy', $allowance) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this allowance?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
