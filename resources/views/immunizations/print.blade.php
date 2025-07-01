<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Immunization Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        h2, h4 { margin: 0; padding: 0; }
    </style>
</head>
<body>

<h2>Immunization Record</h2>
<h4>Patient: {{ $patient->full_name }} | ID: {{ $patient->id_number ?? '-' }}</h4>
<p><strong>Printed on:</strong> {{ now()->format('d M Y H:i') }}</p>

<table>
    <thead>
        <tr>
            <th>Vaccine</th>
            <th>Dose</th>
            <th>Recommended Age</th>
            <th>Given</th>
            <th>Date Given</th>
            <th>Remarks</th>
        </tr>
    </thead>
    <tbody>
        @foreach($patient->immunizationRecords as $record)
            <tr>
                <td>{{ $record->schedule->vaccine_name }}</td>
                <td>{{ $record->schedule->dose_label }}</td>
                <td>{{ $record->schedule->recommended_age_weeks }} wks</td>
                <td>{{ $record->is_given ? 'Yes' : 'No' }}</td>
                <td>{{ $record->given_date }}</td>
                <td>{{ $record->remarks }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
