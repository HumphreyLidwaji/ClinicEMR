@extends('layouts.app')

@section('content')
<div class="container">
    <h4>{{ isset($item) ? 'Edit' : 'Add' }} Systematic Examination</h4>

    <form method="POST" action="{{ isset($item) ? route('systematic-examinations.update', $item->id) : route('systematic-examinations.store') }}">
        @csrf
        @if(isset($item)) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">Finding Name</label>
            <input type="text" name="name" class="form-control" value="{{ $item->name ?? old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">System</label>
            <input type="text" name="system" class="form-control" value="{{ $item->system ?? old('system') }}" required>
        </div>

        <button class="btn btn-primary">{{ isset($item) ? 'Update' : 'Save' }}</button>
    </form>
</div>
@endsection
