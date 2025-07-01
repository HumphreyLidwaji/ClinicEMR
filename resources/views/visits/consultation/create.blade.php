@extends('layouts.app')

@section('title', 'Consultation')

@section('content')

<style>
    .form-section-title {
        font-weight: bold;
        color: #0d6efd;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
        border-bottom: 1px solid #e3e3e3;
        padding-bottom: 0.25rem;
    }

</style>
<div class="container-fluid py-4">
    <div class="card-box bg-white box-shadow border-radius-10">
        <div class="pd-20">
            <h1 class="h4 mb-4 text-primary">{{ __('Consultation') }}</h1>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('consultation.store') }}">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="visit_id" class="form-label">{{ __('Visit') }}</label>
                    <select name="visit_id" class="form-control select2" required>
    @if(isset($visit))
        <option value="{{ $visit->id }}" selected>{{ $visit->patient->name }} ({{ $visit->type }})</option>
    @else
        <option value="">Select Visit</option>
        @foreach($visits as $visit)
            <option value="{{ $visit->id }}">{{ $visit->patient->name }} ({{ $visit->type }})</option>
        @endforeach
    @endif
</select>

                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="notes" class="form-label">{{ __('Consultation Notes') }}</label>
                        <textarea name="notes" rows="3" class="form-control" required></textarea>
                    </div>
                </div>

                <div class="form-section-title">{{ __('Clinical Details') }}</div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="past_history" class="form-label">{{ __('Past History') }}</label>
                        <textarea name="past_history" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="general_examination" class="form-label">{{ __('General Examination') }}</label>
                        <textarea name="general_examination" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="systematic_examination"
                            class="form-label">{{ __('Systematic Examination') }}</label>
                        <textarea name="systematic_examination" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="investigation" class="form-label">{{ __('Investigation') }}</label>
                        <textarea name="investigation" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="diagnosis" class="form-label">{{ __('Diagnosis') }}</label>
                        <textarea name="diagnosis" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="icd11_diagnosis" class="form-label">{{ __('ICD11 Diagnosis') }}</label>
                        <select name="icd11_diagnosis" class="form-control icd11-select" required>
                            <option value="">{{ __('Search ICD11 Diagnosis...') }}</option>
                            @foreach($icd11s as $icd)
                            <option value="{{ $icd->code }} - {{ $icd->description }}">{{ $icd->code }} -
                                {{ $icd->description }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="treatment_plan" class="form-label">{{ __('Treatment Plan') }}</label>
                        <textarea name="treatment_plan" rows="2" class="form-control"></textarea>
                    </div>
                </div>

                <button class="btn btn-primary">{{ __('Save Notes') }}</button>
            </form>
        </div>
    </div>
</div>

@endsection


@push('scripts')
<script>
    $(document).ready(function() {
        $('.icd11-select, .select2').select2({
            placeholder: "{{ __('Search...') }}",
            allowClear: true
        });
    });
</script>
@endpush
