
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4>New Admission Request</h4>
    <form action="{{ route('admissions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="patient_id" class="form-label">Patient</label>
            <select name="patient_id" id="patient_id" class="form-select form-control select2" required>
                <option value="">Select Patient</option>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->first_name }}</option>
                @endforeach
            </select>
        </div>
 
<div class="mb-3">
    <label for="visit_id" class="form-label">Visit</label>
    <select name="visit_id" id="visit_id" class="form-select form-control select2" required>
        <option value="">Select Visit</option>
        @foreach($visits as $visit)
            <option value="{{ $visit->id }}">
                Visit #{{ $visit->id }} - {{ $visit->patient->first_name }} {{ $visit->patient->last_name ?? '' }}
            </option>
        @endforeach
    </select>
</div>
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea name="notes" id="notes" class="form-control"></textarea>
        </div>
        <button class="btn btn-success">Submit Admission Request</button>
    </form>
</div>
@endsection

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%',
            placeholder: 'Select an option',
            allowClear: true
        });
    });
</script>
@endpush