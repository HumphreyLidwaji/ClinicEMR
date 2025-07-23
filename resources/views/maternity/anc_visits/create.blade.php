@extends('layouts.app')

@section('content')
<div class="container">
    <h4>New ANC Visit for {{ $case->patient->full_name }}</h4>

    <form method="POST" action="{{ route('cases.anc-visits.store', $case->id) }}">
        @csrf

        <div class="mb-3">
            <label for="visit_date" class="form-label">Visit Date</label>
            <input type="date" name="visit_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="visit_id" class="form-label">Link to Visit (optional)</label>
            <select name="visit_id" class="form-select">
                <option value="">-- Select Visit --</option>
                @foreach($visits as $visit)
                    <option value="{{ $visit->id }}">{{ $visit->visit_type }} | {{ $visit->created_at->format('d M Y') }}</option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Weight (kg)</label>
                <input type="number" step="0.1" name="weight" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>BP Systolic</label>
                <input type="number" name="bp_systolic" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label>BP Diastolic</label>
                <input type="number" name="bp_diastolic" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label for="fetal_heart_rate" class="form-label">Fetal Heart Rate</label>
            <input type="text" name="fetal_heart_rate" class="form-control">
        </div>

        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" rows="3" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Save Visit</button>
        <a href="{{ route('cases.anc-visits.index', $case->id) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
