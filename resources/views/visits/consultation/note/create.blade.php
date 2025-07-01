
@extends('layouts.app')

@section('title', 'Add Visit Note')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Add Visit Note</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('visits.notes.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="visit_id" class="form-label">Select Visit</label>
                    <select name="visit_id" id="visit_id" class="form-select select2" required>
                        <option value="">-- Select Visit --</option>
                        @foreach($visits as $visit)
                            <option value="{{ $visit->id }}">
                                {{ $visit->id }} - {{ $visit->patient->first_name }} {{ $visit->patient->last_name }} ({{ $visit->start_date }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="note_type" class="form-label">Note Type</label>
                    <select name="note_type" id="note_type" class="form-select" required>
                        <option value="">-- Select Note Type --</option>
                        <option value="general">General</option>
                        <option value="nursing">Nursing</option>
                        <option value="doctor">Doctor</option>
                        <option value="discharge">Discharge</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label">Note</label>
                    <textarea name="note" id="note" class="form-control" rows="5" required>{{ old('note') }}</textarea>
                </div>
                <button class="btn btn-success">Save Note</button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({ width: '100%' });
    });
</script>
@endpush
@endsection