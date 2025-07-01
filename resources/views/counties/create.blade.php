@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Add County</h2>

    <form action="{{ route('counties.store') }}" method="POST" class="card card-body shadow-sm">
        @csrf
        <div class="mb-3">
            <label class="form-label">County Name</label>
            <input type="text" name="county_name" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('counties.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </form>
</div>
@endsection
