@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Ward</h2>

    <form action="{{ route('sub_county_wards.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="ward_name" class="form-label">Ward Name</label>
            <input type="text" name="ward_name" class="form-control" value="{{ old('ward_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="subcounty_id" class="form-label">Subcounty</label>
            <select name="subcounty_id" class="form-select" required>
                <option value="">Select Subcounty</option>
                @foreach($subcounties as $subcounty)
                    <option value="{{ $subcounty->id }}">{{ $subcounty->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('sub_county_wards.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
