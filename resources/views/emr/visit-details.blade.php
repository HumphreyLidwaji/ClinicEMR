@extends('layouts.app')

@section('title', 'Visit Details')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="card-title mb-3 text-primary">
                Visit Details: <span class="text-dark">{{ $visit->visit_number }}</span>
            </h4>
            <h6 class="mb-4">Patient: <strong>{{ $visit->patient->full_name }}</strong></h6>

            <hr>

            {{-- Vitals --}}
            <div class="mb-4">
                <h5 class="text-secondary">Vitals</h5>
                @if($visit->vital)
                    <ul class="list-group">
                        <li class="list-group-item">Blood Pressure: {{ $visit->vital->blood_pressure }}</li>
                        <li class="list-group-item">Temperature: {{ $visit->vital->temperature }}°C</li>
                        <li class="list-group-item">Pulse: {{ $visit->vital->pulse }} bpm</li>
                    </ul>
                @else
                    <p class="text-muted">No vitals recorded.</p>
                @endif
            </div>

{{-- Consultation Section --}}
<div class="mb-4">
    <h5 class="text-secondary">Consultation Details</h5>

    {{-- Notes --}}
    <div class="border rounded p-3 bg-light mb-2">
        <strong>Notes:</strong><br>
        @if($visitNotes->count())
            @foreach($visitNotes as $note)
                <p><strong>{{ $note->note_type }}:</strong> {!! nl2br(e($note->note)) !!}</p>
            @endforeach
        @else
            <p>N/A</p>
        @endif
    </div>

    {{-- Past History --}}
    <div class="border rounded p-3 bg-light mb-2">
        <strong>Past History:</strong><br>
        {{ $consultationHistory->past_history ?? 'N/A' }}
    </div>

    {{-- General Examination --}}
    <div class="border rounded p-3 bg-light mb-2">
        <strong>General Examination:</strong><br>
        {{ $consultationHistory->general_examination ?? 'N/A' }}
    </div>

    {{-- Systematic Examinations --}}
    <div class="border rounded p-3 bg-light mb-2">
        <strong>Systematic Examinations:</strong><br>
        @if($consultationSystematicExaminations->count())
            <ul>
                @foreach($consultationSystematicExaminations as $sysExam)
                    <li>{{ $sysExam->systematicExamination->name ?? 'Unknown' }}</li>
                @endforeach
            </ul>
        @else
            N/A
        @endif
    </div>

    {{-- Investigations --}}
    <div class="border rounded p-3 bg-light mb-2">
        <strong>Investigation:</strong><br>
        {{ $consultationHistory->investigation ?? 'N/A' }}
    </div>

    {{-- Diagnoses --}}
    <div class="border rounded p-3 bg-light mb-2">
        <strong>Diagnosis:</strong><br>
        @if($consultationDiagnoses->count())
            <ul>
                @foreach($consultationDiagnoses as $diag)
                    <li>{{ $diag->diagnosis->name ?? 'Unknown' }} 
                    @if($diag->note)
                        - <em>{{ $diag->note }}</em>
                    @endif
                    </li>
                @endforeach
            </ul>
        @else
            N/A
        @endif
    </div>

    {{-- ICD-11 Diagnoses --}}
    <div class="border rounded p-3 bg-light mb-2">
        <strong>ICD-11 Diagnosis:</strong><br>
        @if($consultationICD11s->count())
            <ul>
                @foreach($consultationICD11s as $icd)
                   <li>{{ $icd->icd11->code ?? 'Unknown' }} - {{ $icd->icd11->description ?? '' }}</li>

                @endforeach
            </ul>
        @else
            N/A
        @endif
    </div>

    {{-- Treatment Plan --}}
    <div class="border rounded p-3 bg-light mb-2">
        <strong>Treatment Plan:</strong><br>
        {{ $treatmentPlan ?? 'N/A' }}
    </div>
</div>



            {{-- Prescriptions --}}
            <div class="mb-4">
                <h5 class="text-secondary">Prescriptions</h5>
                @if($visit->prescriptions->count())
                    <ul class="list-group">
                        @foreach($visit->prescriptions as $rx)
                            <li class="list-group-item">
                                {{ $rx->drug->name }} — {{ $rx->dosage }} × {{ $rx->duration }} days
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No prescriptions recorded.</p>
                @endif
            </div>

            {{-- Lab Orders --}}
            <div class="mb-4">
                <h5 class="text-secondary">Lab Orders</h5>
                @if($visit->labOrders->count())
                    <ul class="list-group">
                        @foreach($visit->labOrders as $lab)
                            <li class="list-group-item">
                                {{ $lab->labTest->name }} — <span class="badge bg-info">{{ ucfirst($lab->status) }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No lab orders placed.</p>
                @endif
            </div>

            {{-- Radiology Orders --}}
            <div class="mb-4">
                <h5 class="text-secondary">Radiology Orders</h5>
                @if($visit->radiologyOrders->count())
                    <ul class="list-group">
                        @foreach($visit->radiologyOrders as $rad)
                            <li class="list-group-item">
                             @if ($rad->radiologyService)
    {{ $rad->radiologyService->name }} — <span class="badge bg-info">{{ ucfirst($rad->status) }}</span>
@else
    <span class="text-danger">Service not found</span> — <span class="badge bg-info">{{ ucfirst($rad->status) }}</span>
@endif

                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No radiology orders placed.</p>
                @endif
            </div>

            {{-- Procedures --}}
            <div class="mb-4">
                <h5 class="text-secondary">Procedures</h5>
                @if($visit->procedureOrders->count())
                    <ul class="list-group">
                        @foreach($visit->procedureOrders as $proc)
                            <li class="list-group-item">
                                {{ $proc->procedure->name }} — <span class="badge bg-info">{{ ucfirst($proc->status) }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No procedures recorded.</p>
                @endif
            </div>

            {{-- Services --}}
            <div class="mb-4">
                <h5 class="text-secondary">Services</h5>
                @if($visit->serviceOrders->count())
                    <ul class="list-group">
                        @foreach($visit->serviceOrders as $svc)
                            <li class="list-group-item">
                                {{ $svc->service->name }} — <span class="badge bg-info">{{ ucfirst($svc->status) }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No services rendered.</p>
                @endif
            </div>

            {{-- Invoice --}}
          <!--  <div class="mb-4">
                <h5 class="text-secondary">Invoice</h5>
                @if($visit->invoice)
                    <p><strong>Invoice #:</strong> {{ $visit->invoice->invoice_number }}</p>
                    <ul class="list-group">
                        @foreach($visit->invoice->items as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item->description }}
                                <span>KES {{ number_format($item->total, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="text-end mt-2">
                        <strong>Total Amount:</strong> KES {{ number_format($visit->invoice->amount, 2) }}
                    </div>
                @else
                    <p class="text-muted">No invoice available for this visit.</p>
                @endif
            </div>-->

            {{-- Print Button --}}
            <div class="text-end">
                <a href="{{ route('emr.visit.print', $visit->id) }}" class="btn btn-outline-primary" target="_blank">
                    <i class="bi bi-printer"></i> Print Summary
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
