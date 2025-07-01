@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        {{-- Card Header with Hospital Branding --}}
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-white">{{ config('hospital.name') }} — Discharge Summary</h5>
            <small class="text-light">
                {{ config('hospital.code') }} |
                {{ config('hospital.address') }} |
                {{ config('hospital.phone') }}
            </small>
        </div>

        {{-- Card Body --}}
        <div class="card-body">
            <h6 class="text-secondary mb-3">Patient Information</h6>
            <dl class="row">
                <dt class="col-sm-3">Name</dt>
                <dd class="col-sm-9">{{ $summary->visit->patient->first_name }} {{ $summary->visit->patient->last_name }}</dd>

                <dt class="col-sm-3">Discharge Date</dt>
                <dd class="col-sm-9">
                    {{ \Carbon\Carbon::parse($summary->discharge_date)->format('j M, Y') }}
                </dd>

                <dt class="col-sm-3">Outcome</dt>
                <dd class="col-sm-9">{{ ucfirst($summary->outcome) }}</dd>

                <dt class="col-sm-3">Attending Doctor</dt>
                <dd class="col-sm-9">{{ $summary->doctor->name ?? 'N/A' }}</dd>

    <dt class="col-sm-3">ICD-11 Diagnosis</dt>
<dd class="col-sm-9">
    @if($summary->icd11)
        {{ $summary->icd11->code }} - {{ $summary->icd11->description }}
    @else
        <em>No ICD-11 Diagnosis</em>
    @endif
</dd>


            </dl>

            <hr>

            <h6 class="text-secondary">Clinical Summary</h6>
            <p class="border-left pl-3">{{ $summary->summary }}</p>

            @if($summary->outcome === 'referred')
                <h6 class="text-secondary mt-4">Referral Details</h6>
                <p class="border-left pl-3">{{ $summary->referral_note }}</p>
            @endif

            @if($summary->outcome === 'death')
                <h6 class="text-secondary mt-4">Cause of Death</h6>
                <p class="border-left pl-3">{{ $summary->death_note }}</p>
            @endif
        </div>

        {{-- Card Footer with Download Button --}}
        <div class="card-footer d-flex justify-content-end">
            <a href="{{ route('discharge.pdf', $summary->id) }}"
               class="btn btn-outline-primary">
                <i class="fas fa-file-pdf"></i> Download PDF
            </a>
        </div>
    </div>
</div>
@endsection
