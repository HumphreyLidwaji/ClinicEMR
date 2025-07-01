@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Ward</h2>

    <form action="{{ route('sub_county_wards.update', $subCountyWard) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="ward_name" class="form-label">Ward Name</label>
            <input type="text" name="ward_name" class="form-control" value="{{ old('ward_name', $subCountyWard->ward_name) }}" required>
        </div>

        <div class="mb-3">
            <label for="subcounty_id" class="form-label">Subcounty</label>
            <select name="subcounty_id" class="form-select" required>
                <option value="">Select Subcounty</option>
                @foreach($subcounties as $subcounty)
                    <option value="{{ $subcounty->id }}" @if($subCountyWard->subcounty_id == $subcounty->id) selected @endif>
                        {{ $subcounty->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('sub_county_wards.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
 