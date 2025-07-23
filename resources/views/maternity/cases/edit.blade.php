@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Edit Maternity Case</h4>

    <form action="{{ route('cases.update', $case->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="patient_id" class="form-label">Patient</label>
            <select name="patient_id" class="form-select" required>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" {{ $case->patient_id == $patient->id ? 'selected' : '' }}>
                        {{ $patient->full_name }} ({{ $patient->id_number ?? 'No ID' }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="visit_id" class="form-label">Linked Visit (optional)</label>
            <select name="visit_id" class="form-select">
                <option value="">-- No Visit --</option>
                @foreach($visits as $visit)
                    <option value="{{ $visit->id }}" {{ $case->visit_id == $visit->id ? 'selected' : '' }}>
                        {{ $visit->visit_type }} — {{ $visit->created_at->format('d M Y') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="mb-3 col-md-4">
                <label for="lmp" class="form-label">LMP</label>
                <input type="date" name="lmp" class="form-control" value="{{ $case->lmp }}" required>
            </div>

            <div class="mb-3 col-md-4">
                <label for="gravida" class="form-label">Gravida</label>
                <input type="number" name="gravida" class="form-control" value="{{ $case->gravida }}">
            </div>

            <div class="mb-3 col-md-4">
                <label for="parity" class="form-label">Parity</label>
                <input type="number" name="parity" class="form-control" value="{{ $case->parity }}">
            </div>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" class="form-control" rows="3">{{ $case->notes }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Case</button>
        <a href="{{ route('cases.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
