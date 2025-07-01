@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Add Baby for Delivery on {{ \Carbon\Carbon::parse($delivery->delivery_date)->format('d M Y') }}</h4>

    <form method="POST" action="{{ route('deliveries.babies.store', $delivery->id) }}">
        @csrf

        {{-- Baby Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Baby Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        {{-- Date of Birth --}}
        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" name="dob" class="form-control" value="{{ $delivery->delivery_date->format('Y-m-d') }}" required>
        </div>

        {{-- Gender --}}
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" class="form-select" required>
                <option value="">-- Select --</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>

        {{-- Birth Weight --}}
        <div class="mb-3">
            <label for="birth_weight" class="form-label">Birth Weight (kg)</label>
            <input type="number" name="birth_weight" class="form-control" step="0.01" min="0" max="10">
        </div>

        {{-- Apgar Score --}}
        <div class="mb-3">
            <label for="apgar_score" class="form-label">Apgar Score (0-10)</label>
            <input type="number" name="apgar_score" class="form-control" min="0" max="10">
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="">-- Select --</option>
                <option value="alive">Alive</option>
                <option value="stillbirth">Stillbirth</option>
                <option value="neonatal death">Neonatal Death</option>
            </select>
        </div>

        <hr>

        {{-- Guardian Information (Optional) --}}
        <h5>Guardian (Optional)</h5>

        <div class="mb-3">
            <label for="guardian_name" class="form-label">Guardian Name</label>
            <input type="text" name="guardian_name" class="form-control">
        </div>

        <div class="mb-3">
            <label for="guardian_relationship" class="form-label">Relationship</label>
            <input type="text" name="guardian_relationship" class="form-control">
        </div>

        <div class="mb-3">
            <label for="guardian_phone" class="form-label">Guardian Phone</label>
            <input type="text" name="guardian_phone" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Save Baby</button>
    </form>
</div>
@endsection
