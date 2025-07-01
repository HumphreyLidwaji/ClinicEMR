@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">New Maternity Case</h4>

    <form action="{{ route('cases.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="patient_id" class="form-label">Patient</label>
            <select name="patient_id" class="form-select" required>
                <option value="">-- Select Patient --</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->full_name }} ({{ $patient->id_number ?? 'No ID' }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="visit_id" class="form-label">Linked Visit (optional)</label>
            <select name="visit_id" class="form-select">
                <option value="">-- No Visit --</option>
                @foreach($visits as $visit)
                    <option value="{{ $visit->id }}">{{ $visit->visit_type }} — {{ $visit->created_at->format('d M Y') }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="mb-3 col-md-4">
                <label for="lmp" class="form-label">Last Menstrual Period (LMP)</label>
                <input type="date" name="lmp" class="form-control" required>
            </div>

            <div class="mb-3 col-md-4">
                <label for="gravida" class="form-label">Gravida</label>
                <input type="number" name="gravida" class="form-control">
            </div>

            <div class="mb-3 col-md-4">
                <label for="parity" class="form-label">Parity</label>
                <input type="number" name="parity" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Save Case</button>
        <a href="{{ route('cases.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
