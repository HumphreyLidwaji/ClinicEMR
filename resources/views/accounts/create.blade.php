
@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-white">Add Account</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('accounts.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select form-control" required>
                        <option value="asset">Asset</option>
                        <option value="liability">Liability</option>
                        <option value="equity">Equity</option>
                        <option value="income">Income</option>
                        <option value="expense">Expense</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Code</label>
                    <input type="text" name="code" class="form-control" required>
                </div>
                <button class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection