@extends('layouts.app')

@section('content')
    <h2>Edit Subcounty</h2>
    <form action="{{ route('subcounties.update', $subcounty->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>County</label>
            <select name="county_id" class="form-control" required>
                @foreach ($counties as $county)
                    <option value="{{ $county->id }}" {{ $subcounty->county_id == $county->id ? 'selected' : '' }}>
                        {{ $county->county_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Constituency Name</label>
            <input type="text" name="constituency_name" class="form-control" value="{{ $subcounty->constituency_name }}" required>
        </div>
        <div class="mb-3">
            <label>Ward</label>
            <input type="text" name="ward" class="form-control" value="{{ $subcounty->ward }}" required>
        </div>
        <div class="mb-3">
            <label>Alias</label>
            <input type="text" name="alias" class="form-control" value="{{ $subcounty->alias }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('subcounties.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
