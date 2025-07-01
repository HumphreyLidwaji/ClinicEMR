@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Bank Accounts</h1>
    <a href="{{ route('bank-accounts.create') }}" class="btn btn-success mb-3">Add Bank Account</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Bank</th>
                <th>Account Name</th>
                <th>Account Number</th>
                <th>Account Type</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($accounts as $account)
            <tr>
                <td>{{ $account->bank->name }}</td>
                <td>{{ $account->account_name }}</td>
                <td>{{ $account->account_number }}</td>
                <td>{{ $account->account_type }}</td>
                <td>
                    <a href="{{ route('bank-accounts.edit', $account->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('bank-accounts.destroy', $account->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this account?')">
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
