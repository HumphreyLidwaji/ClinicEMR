
@extends('layouts.app')

@section('title', 'Add Patient Attachment')

@section('content')
<div class="container py-4">
    <div class="card-box bg-white box-shadow border-radius-10">
        <div class="pd-20">
            <h4 class="mb-4">Add Patient Attachment</h4>
            <form method="POST" action="{{ route('patients.attachments.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Patient</label>
                    <select name="patient_id" class="form-control select2" required>
                        <option value="">Select Patient</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Attachment File</label>
                    <input type="file" name="file" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <input type="text" name="description" class="form-control">
                </div>
                <button class="btn btn-success">Upload Attachment</button>
                <a href="{{ route('patients.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "{{ __('Select...') }}",
            allowClear: true
        });
    });
</script>
@endpush