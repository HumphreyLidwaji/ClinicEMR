@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Allowances</h1>

    <a href="{{ route('allowances.create') }}" class="btn btn-success mb-3">Add Allowance</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Label</th>
                <th>Fixed/Variable</th>
                <th>Amount</th>
                <th width="150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allowances as $allowance)
            <tr>
                <td>{{ $allowance->label }}</td>
                <td>{{ $allowance->type }}</td>
                <td>{{ $allowance->amount }}</td>
                <td>
                    <a href="{{ route('allowances.edit', $allowance->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('allowances.destroy', $allowance->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this allowance?')">
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
