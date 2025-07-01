<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Discharge Summary</title>
    <style>
        @page {
            margin: 100px 40px 100px 40px;
        }

        body {
            font-family: "Segoe UI", Tahoma, sans-serif;
            font-size: 14px;
            color: #333;
            line-height: 1.6;
            position: relative;
        }

        /* Watermark */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(0, 0, 0, 0.08);
            z-index: -1000;
            white-space: nowrap;
            pointer-events: none;
        }

        header {
            position: fixed;
            top: -90px;
            left: 0;
            right: 0;
            height: 90px;
            border-bottom: 2px solid #4CAF50;
            padding: 10px 0;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            height: 70px;
        }

        .hospital-info {
            text-align: right;
            line-height: 1.2;
        }

        .hospital-info .name {
            font-size: 20px;
            font-weight: bold;
            color: #2E7D32;
        }

        footer {
            position: fixed;
            bottom: -70px;
            left: 0;
            right: 0;
            height: 60px;
            border-top: 1px solid #ccc;
            text-align: center;
            font-size: 12px;
            color: #888;
            padding-top: 10px;
        }

        .section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }

        h2 {
            margin-top: 30px;
            color: #2E7D32;
            border-bottom: 2px solid #ccc;
            padding-bottom: 5px;
        }

        h4 {
            color: #555;
            margin-bottom: 8px;
        }

        .label {
            font-weight: bold;
            width: 180px;
            display: inline-block;
        }

        .note {
            border-left: 4px solid #ccc;
            background: #f9f9f9;
            padding: 10px;
            margin-top: 5px;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .page-break {
            page-break-after: always;
        }

    </style>
</head>

<body>

    {{-- Watermark --}}
    <div class="watermark">CONFIDENTIAL</div>

    {{-- Header --}}
    <header>
        <div class="header-content">
            <img src="{{ public_path('images/hospital_logo.png') }}" alt="Hospital Logo" class="logo">

            <div class="hospital-info">
                <div class="name">{{ config('hospital.name') }}</div>
                <div>{{ config('hospital.address') }}</div>
                <div>Phone: {{ config('hospital.phone') }} | Email: {{ config('hospital.email') }}</div>
                <div>Code: {{ config('hospital.code') }}</div>
            </div>
        </div>
    </header>

    {{-- Footer --}}
    <footer>
        {{ config('hospital.name') }} — Discharge Summary | Page <span class="pagenum"></span>
    </footer>

    {{-- Main Content --}}
    <main>
        <h2>Discharge Summary</h2>

        <div class="section">
            <div><span class="label">Patient Name:</span> {{ $summary->visit->patient->first_name }}
                {{ $summary->visit->patient->last_name }}</div>
            <div><span class="label">Discharge Date:</span>
                {{ \Carbon\Carbon::parse($summary->discharge_date)->format('d M Y') }}</div>
            <div><span class="label">Outcome:</span> {{ ucfirst($summary->outcome) }}</div>
            <div><span class="label">Doctor:</span> {{ $summary->doctor->name ?? 'N/A' }}</div>
            <div><span class="label">ICD-11 Diagnosis:</span>{{ $summary->icd11->code }} -
                {{ $summary->icd11->description }}</div>


        </div>

        <div class="section">
            <h4>Clinical Summary</h4>
            <div class="note">{{ $summary->summary }}</div>
        </div>

        @if($summary->visit->prescriptions->where('is_discharge_med', true)->count())
        <div class="section page-break">
            <h4>Discharge Medications</h4>
            <table style="width: 100%; border-collapse: collapse; font-size: 13px;" border="1" cellpadding="6">
                <thead style="background: #f0f0f0;">
                    <tr>
                        <th>#</th>
                        <th>Drug</th>
                        <th>Dosage</th>
                        <th>Route</th>
                        <th>Duration (days)</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($summary->visit->prescriptions->where('is_discharge_med', true) as $i => $rx)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $rx->drug->name ?? '—' }}</td>
                        <td>{{ $rx->dosage->name ?? '—' }}</td>
                        <td>{{ $rx->route->name ?? '—' }}</td>
                        <td>{{ $rx->duration }}</td>
                        <td>{{ $rx->quantity }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif


        @if($summary->outcome === 'referred')
        <div class="section page-break">
            <h4>Referral Note</h4>
            <div class="note">{{ $summary->referral_note }}</div>
        </div>
        @endif

        @if($summary->outcome === 'death')
        <div class="section page-break">
            <h4>Cause of Death</h4>
            <div class="note">{{ $summary->death_note }}</div>
        </div>
        @endif
    </main>

</body>

</html>
