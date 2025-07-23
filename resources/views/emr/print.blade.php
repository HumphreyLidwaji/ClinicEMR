<!DOCTYPE html>
<html>
<head>
    <title>EMR Visit Print</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; font-size: 14px; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #444; padding-bottom: 10px; margin-bottom: 20px; }
        .header img { height: 70px; }
        .hospital-details { text-align: right; }
        h2 { margin-top: 30px; border-bottom: 1px solid #ccc; padding-bottom: 5px; color: #2c3e50; }
        ul { padding-left: 20px; }
        li { margin-bottom: 5px; }
        .section { margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="header">
    <div class="logo">
        <img src="{{ public_path(config('app.hospital.logo')) }}" alt="Hospital Logo">
    </div>
    <div class="hospital-details">
        <strong>{{ config('app.hospital.name') }}</strong><br>
        {{ config('app.hospital.address') }}<br>
        Phone: {{ config('app.hospital.phone') }}<br>
        Email: {{ config('app.hospital.email') }}
    </div>
</div>

<h2>Visit Summary - {{ $visit->visit_number }}</h2>
<p><strong>Patient:</strong> {{ $visit->patient->full_name }} ({{ $visit->patient->patient_no }})</p>
<p><strong>Visit Type:</strong> {{ $visit->type }}</p>
<p><strong>Date:</strong> {{ \Carbon\Carbon::parse($visit->start_date)->format('d M Y, H:i') }}</p>

<div class="section">
    <h4>Vitals</h4>
    @if($visit->vital)
        <p>
            BP: {{ $visit->vital->blood_pressure }} |
            Temp: {{ $visit->vital->temperature }}°C |
            Pulse: {{ $visit->vital->pulse }} bpm
        </p>
    @else
        <p>No vitals recorded.</p>
    @endif
</div>

<div class="section">
    <h4>Consultation Notes</h4>
    @if($visitNotes->count())
        <ul>
            @foreach($visitNotes as $note)
                <li><strong>{{ $note->note_type }}:</strong> {{ $note->note }}</li>
            @endforeach
        </ul>
    @else
        <p>No consultation notes available.</p>
    @endif
</div>

@if($consultationHistory)
    <div class="section">
        <h4>Consultation History</h4>
        <p><strong>Past History:</strong> {{ $consultationHistory->past_history }}</p>
        <p><strong>General Examination:</strong> {{ $consultationHistory->general_examination }}</p>
        <p><strong>Investigation:</strong> {{ $consultationHistory->investigation }}</p>
    </div>
@endif

@if($consultationSystematicExaminations->count())
    <div class="section">
        <h4>Systematic Examinations</h4>
        <ul>
            @foreach($consultationSystematicExaminations as $sys)
                <li>{{ $sys->systematicExamination->system ?? 'Unnamed Exam' }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if($consultationDiagnoses->count())
    <div class="section">
        <h4>Clinical Diagnoses</h4>
        <ul>
            @foreach($consultationDiagnoses as $diag)
                <li>{{ $diag->diagnosis->name ?? 'Unnamed Diagnosis' }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if($consultationICD11s->count())
    <div class="section">
        <h4>ICD-11 Diagnoses</h4>
        <ul>
            @foreach($consultationICD11s as $icd)
                <li>{{ $icd->icd11->code ?? 'Unknown' }} - {{ $icd->icd11->description ?? '' }}</li>

            @endforeach
        </ul>
    </div>
@endif

@if($treatmentPlan)
    <div class="section">
        <h4>Treatment Plan</h4>
        <p>{{ $treatmentPlan }}</p>
    </div>
@endif

<div class="section">
    <h4>Prescriptions</h4>
    @if($visit->prescriptions->count())
        <ul>
            @foreach($visit->prescriptions as $rx)
                <li>{{ $rx->drug->name }} - {{ $rx->dosage }} x {{ $rx->duration }} days</li>
            @endforeach
        </ul>
    @else
        <p>No prescriptions recorded.</p>
    @endif
</div>

<div class="section">
    <h4>Investigations</h4>
    <ul>
        @foreach($visit->labOrders as $lab)
            <li>Lab: {{ $lab->labTest->name }} - {{ ucfirst($lab->status) }}</li>
        @endforeach
        @foreach($visit->radiologyOrders as $rad)
            <li>Radiology: {{ $rad->radiologyService->name ?? 'Unknown' }} - {{ ucfirst($rad->status) }}</li>
        @endforeach
    </ul>
</div>

<div class="section">
    <h4>Billing</h4>
    @if($visit->invoice)
        <ul>
            @foreach($visit->invoice->items as $item)
                <li>{{ $item->description }} - KES {{ number_format($item->total, 2) }}</li>
            @endforeach
        </ul>
        <p><strong>Total: KES {{ number_format($visit->invoice->amount, 2) }}</strong></p>
    @else
        <p>No invoice available.</p>
    @endif
</div>

<script>
    window.onload = function () {
        window.print();
    }
</script>

</body>
</html>
