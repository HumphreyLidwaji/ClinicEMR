@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Baby Record</h4>

    <form method="POST" action="{{ route('babies.update', $baby->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name">Baby Name</label>
            <input type="text" name="name" class="form-control" value="{{ $baby->name }}" required>
        </div>

        <div class="mb-3">
            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" class="form-control" value="{{ $baby->dob->format('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label for="gender">Gender</label>
            <select name="gender" class="form-select" required>
                <option value="">-- Select --</option>
                <option value="male" {{ $baby->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $baby->gender == 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="birth_weight">Birth Weight (kg)</label>
            <input type="number" name="birth_weight" class="form-control" step="0.01" value="{{ $baby->birth_weight }}">
        </div>

        <div class="mb-3">
            <label for="apgar_score">Apgar Score</label>
            <input type="number" name="apgar_score" class="form-control" value="{{ $baby->apgar_score }}">
        </div>

        <div class="mb-3">
            <label for="status">Status</label>
            <select name="status" class="form-select">
                <option value="">-- Select --</option>
                <option value="alive" {{ $baby->status == 'alive' ? 'selected' : '' }}>Alive</option>
                <option value="stillbirth" {{ $baby->status == 'stillbirth' ? 'selected' : '' }}>Stillbirth</option>
                <option value="neonatal death" {{ $baby->status == 'neonatal death' ? 'selected' : '' }}>Neonatal Death</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
