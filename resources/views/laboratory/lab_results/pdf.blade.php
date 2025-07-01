<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lab Result PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #333; padding: 5px; text-align: left; }
        th { background-color: #f0f0f0; }
        .flag-HIGH { color: red; font-weight: bold; }
        .flag-LOW { color: blue; font-weight: bold; }
        .flag-NORMAL { color: green; }
        .header, .footer { text-align: center; margin-top: 10px; }
        .summary-box { margin-top: 20px; border: 1px solid #999; padding: 10px; }
        .signature-box { margin-top: 40px; }
        .qr { float: right; }
    </style>
</head>
<body>

    {{-- Hospital Info --}}
    <div class="header">
                <img src="{{ asset('images/hospital-logo.png') }}" alt="Hospital Logo" style="width: 100px; height: auto;">
        <h1>{{ config('app.hospital.name') }}</h1>
<p>{{ config('app.hospital.address') }} | {{ config('app.hospital.phone') }} | {{ config('app.hospital.email') }}</p>

        <hr>
    </div>

    {{-- Report Title --}}
    <div class="header">
        <h2 style="margin-bottom: 5px;">Laboratory Report</h2>
        <p>Order #: {{ $result->order->id }} | Date: {{ $result->resulted_at->format('d M Y') }}</p>
    </div>

    {{-- Patient Details --}}
    <table>
        <tr>
            <td><strong>Patient Name:</strong></td><td>{{ $result->order->visit->patient->full_name }}</td>
            <td><strong>Gender:</strong></td><td>{{ $result->order->visit->patient->gender }}</td>
        </tr>
        <tr>
            <td><strong>Patient ID:</strong></td><td>{{ $result->order->visit->patient->id }}</td>
            <td><strong>Age:</strong></td><td>{{ $result->order->visit->patient->age }}</td>
        </tr>
    </table>

    {{-- Results Table --}}
    <table>
        <thead>
            <tr>
                <th>Test</th>
                <th>Value</th>
                <th>Unit</th>
                <th>Reference</th>
                <th>Flag</th>
            </tr>
        </thead>
        <tbody>
            @php
                $results = is_array($result->results) ? $result->results : json_decode($result->results, true);
            @endphp
            @foreach($results as $name => $item)
                <tr>
                    <td>{{ $name }}</td>
                    <td>{{ $item['value'] }}</td>
                    <td>{{ $item['unit'] ?? '' }}</td>
                    <td>{{ $item['reference'] ?? '' }}</td>
                    <td class="flag-{{ strtoupper($item['flag'] ?? 'NORMAL') }}">
                        {{ $item['flag'] ?? '-' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Summary --}}
    <div class="summary-box">
        <strong>Summary:</strong>
        <p>
            @php
                $flags = collect($results)->pluck('flag')->filter();
                $highCount = $flags->filter(fn($f) => strtolower($f) == 'high')->count();
                $lowCount = $flags->filter(fn($f) => strtolower($f) == 'low')->count();
            @endphp
            {{ $highCount }} High, {{ $lowCount }} Low, {{ count($results) - $highCount - $lowCount }} Normal results.
        </p>
    </div>

    {{-- Signature --}}
    <div class="signature-box">
        <p><strong>Remarks:</strong></p>
        <p>....................................................................................</p>

        <p style="margin-top: 40px;">Authorized By: ____________________________</p>
        <p>Date: ____________________________</p>
    </div>

   

</body>
</html>
