
@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0 text-white">Edit Lab Test</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('lab-tests.update', $labTest) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name', $labTest->name) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" step="0.01" min="0" required value="{{ old('price', $labTest->price) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ old('description', $labTest->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Account</label>
                    <select name="account_id" class="form-select" required>
                        <option value="">Select Account</option>
                        @foreach($accounts as $account)
                            <option value="{{ $account->id }}" {{ (old('account_id', $labTest->account_id) == $account->id) ? 'selected' : '' }}>
                                {{ $account->name }} ({{ $account->type }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-success">Update Lab Test</button>
            </form>
        </div>
    </div>
</div>
@endsection