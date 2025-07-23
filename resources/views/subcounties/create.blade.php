@extends('layouts.app')

@section('content')
    <h2>Add Subcounty</h2>
    <form action="{{ route('subcounties.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>County</label>
            <select name="county_id" class="form-control" required>
                <option value="">Select County</option>
                @foreach ($counties as $county)
                    <option value="{{ $county->id }}">{{ $county->county_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Constituency Name</label>
            <input type="text" name="constituency_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Ward</label>
            <input type="text" name="ward" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alias</label>
            <input type="text" name="alias" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('subcounties.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
