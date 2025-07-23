@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Record Delivery for {{ $case->patient->full_name }}</h4>

    <form method="POST" action="{{ route('cases.deliveries.store', $case->id) }}">
        @csrf

        <div class="mb-3">
            <label for="delivery_date" class="form-label">Delivery Date</label>
            <input type="datetime-local" name="delivery_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="delivery_type" class="form-label">Delivery Type</label>
            <select name="delivery_type" class="form-select" required>
                <option value="">-- Select --</option>
                <option value="Spontaneous">Spontaneous</option>
                <option value="C-Section">C-Section</option>
                <option value="Vacuum">Vacuum</option>
                <option value="Forceps">Forceps</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="visit_id" class="form-label">Linked Visit (optional)</label>
            <select name="visit_id" class="form-select">
                <option value="">-- None --</option>
                @foreach($visits as $visit)
                    <option value="{{ $visit->id }}">{{ $visit->visit_type }} on {{ $visit->created_at->format('d M Y') }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="complications" class="form-label">Complications</label>
            <textarea name="complications" rows="3" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Save Delivery</button>
        <a href="{{ route('cases.show', $case->id) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
