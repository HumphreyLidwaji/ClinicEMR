<!DOCTYPE html>
<html>
<head>
    <title>Birth Certificate</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .cert-box {
            border: 2px solid #333;
            padding: 40px;
            width: 80%;
            margin: 0 auto;
            text-align: center;
        }
        h2 { text-decoration: underline; }
        .info { text-align: left; margin-top: 30px; }
        .info td { padding: 8px 12px; }
    </style>
</head>
<body>
    <div class="cert-box">
        <h2>Birth Certificate</h2>
        <p>This certifies that the following baby was born at our facility:</p>

        <table class="info" align="center">
            <tr><td><strong>Name:</strong></td><td>{{ $baby->name }}</td></tr>
            <tr><td><strong>Date of Birth:</strong></td><td>{{ \Carbon\Carbon::parse($baby->dob)->format('d M Y') }}</td></tr>
            <tr><td><strong>Gender:</strong></td><td>{{ ucfirst($baby->gender) }}</td></tr>
            <tr><td><strong>Birth Weight:</strong></td><td>{{ $baby->birth_weight }} kg</td></tr>
            <tr><td><strong>Status:</strong></td><td>{{ ucfirst($baby->status) }}</td></tr>

            @if($patient)
                <tr><td><strong>Patient No:</strong></td><td>{{ $patient->patient_no }}</td></tr>
            @endif

            <tr><td><strong>Delivery Date:</strong></td><td>{{ optional($baby->delivery)->delivery_date }}</td></tr>
        </table>

        <p style="margin-top: 40px;">Issued by {{ env('APP_NAME', 'ClinicEMR') }}</p>
    </div>
</body>
</html>
