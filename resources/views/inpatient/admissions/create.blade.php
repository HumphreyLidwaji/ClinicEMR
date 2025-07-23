@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded-4 border-0">
                <div class="card-header bg-success text-white fw-bold rounded-top-4">
                    New Admission Request
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admissions.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="visit_id" class="form-label">Visit</label>
                            <select name="visit_id" id="visit_id" class="form-select select2" required>
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
                            <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Enter any relevant notes..."></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">Submit Admission Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
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
