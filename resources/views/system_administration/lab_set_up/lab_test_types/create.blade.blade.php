
@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Add Lab Test</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('lab-tests.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" step="0.01" min="0" required value="{{ old('price') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Account</label>
                    <select name="account_id" class="form-select" required>
                        <option value="">Select Account</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}" {{ old('account_id') == $account->id ? 'selected' : '' }}>
                                {{ $account->name }} ({{ $account->type }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-success">Save Lab Test</button>
            </form>
        </div>
    </div>
</div>
@endsection