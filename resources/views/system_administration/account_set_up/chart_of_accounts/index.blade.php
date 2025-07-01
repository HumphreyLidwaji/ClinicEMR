@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Chart of Accounts</h1>
    <a href="{{ route('chart-of-accounts.create') }}" class="btn btn-success mb-3">Add Account</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Account Code</th>
                <th>Account Name</th>
                <th>Type</th>
                <th>Description</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($accounts as $account)
            <tr>
                <td>{{ $account->code }}</td>
                <td>{{ $account->name }}</td>
                <td>{{ $account->type->name }}</td>
                <td>{{ $account->description ?? '-' }}</td>
                <td>
                    <a href="{{ route('chart-of-accounts.edit', $account->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('chart-of-accounts.destroy', $account->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this account?')">
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
