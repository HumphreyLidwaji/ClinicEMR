<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MoH 510 Maternity Summary</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 13px; }
        h2, h4 { margin: 0; padding: 5px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 4px; text-align: left; }
        .no-border td { border: none; }
    </style>
</head>
<body>

    <h2>Ministry of Health - MoH 510 Maternity Summary</h2>
    <h4>Facility: {{ config('app.name') }}</h4>
    <hr>

    <table class="no-border">
        <tr>
            <td><strong>Patient Name:</strong> {{ $case->patient->full_name }}</td>
            <td><strong>Hospital No:</strong> {{ $case->patient->id_number ?? '-' }}</td>
        </tr>
        <tr>
            <td><strong>LMP:</strong> {{ $case->lmp }}</td>
            <td><strong>EDD:</strong> {{ $case->edd }}</td>
        </tr>
        <tr>
            <td><strong>Gravida:</strong> {{ $case->gravida }}</td>
            <td><strong>Parity:</strong> {{ $case->parity }}</td>
        </tr>
    </table>

    <h4>ANC Visits</h4>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Weight</th>
                <th>BP</th>
                <th>FHR</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($case->ancVisits as $visit)
            <tr>
                <td>{{ $visit->visit_date }}</td>
                <td>{{ $visit->weight }} kg</td>
                <td>{{ $visit->bp_systolic }}/{{ $visit->bp_diastolic }}</td>
                <td>{{ $visit->fetal_heart_rate }}</td>
                <td>{{ $visit->notes }}</td>
            </tr>
            @endforeach
            @if($case->ancVisits->isEmpty())
            <tr><td colspan="5">No records</td></tr>
            @endif
        </tbody>
    </table>

    <h4>Delivery</h4>
    <table>
        <tr><th>Date</th><td>{{ $case->delivery?->delivery_date ?? '-' }}</td></tr>
        <tr><th>Type</th><td>{{ $case->delivery?->delivery_type ?? '-' }}</td></tr>
        <tr><th>Complications</th><td>{{ $case->delivery?->complications ?? '-' }}</td></tr>
    </table>

    <h4>Babies</h4>
    <table>
        <thead>
            <tr>
                <th>Sex</th>
                <th>Birth Weight</th>
                <th>Apgar Score</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($case->delivery?->babies ?? [] as $baby)
                <tr>
                    <td>{{ $baby->sex }}</td>
                    <td>{{ $baby->birth_weight }} kg</td>
                    <td>{{ $baby->apgar_score }}</td>
                    <td>{{ $baby->status }}</td>
                </tr>
            @empty
                <tr><td colspan="4">No baby recorded</td></tr>
            @endforelse
        </tbody>
    </table>

    <br><br>
    <p><strong>Printed on:</strong> {{ now()->format('d M Y H:i') }}</p>
</body>
</html>
