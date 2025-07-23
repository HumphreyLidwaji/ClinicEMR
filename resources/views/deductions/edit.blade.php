@extends('layouts.app')

@section('content')
<div class="container">
    <h4>{{ isset($deduction) ? 'Edit' : 'Create' }} Deduction Rule</h4>

    <form action="{{ isset($deduction) ? route('deductions.update', $deduction) : route('deductions.store') }}" method="POST">
        @csrf
        @if(isset($deduction)) @method('PUT') @endif

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $deduction->name ?? '') }}">
        </div>

        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-control" required>
                <option value="fixed" {{ old('type', $deduction->type ?? '') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                <option value="percentage" {{ old('type', $deduction->type ?? '') == 'percentage' ? 'selected' : '' }}>Percentage</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Value</label>
            <input type="number" step="0.01" name="value" class="form-control" required value="{{ old('value', $deduction->value ?? '') }}">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="is_active" value="1" {{ old('is_active', $deduction->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label">Active</label>
        </div>

        <button class="btn btn-primary">{{ isset($deduction) ? 'Update' : 'Create' }}</button>
        <a href="{{ route('deductions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
