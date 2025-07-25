<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payslip</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .info {
            margin-bottom: 20px;
        }
        .info p {
            margin: 4px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        th, td {
            border: 1px solid #bbb;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        h3 {
            text-align: right;
            margin-top: 30px;
        }
        .footer {
            margin-top: 40px;
            font-size: 0.9rem;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Payslip</h2>

    <div class="info">
        <p><strong>Employee:</strong> {{ $payslip->payroll->employee->first_name }} {{ $payslip->payroll->employee->last_name }}</p>
        <p><strong>Month:</strong> {{ $payslip->payroll->pay_month }}</p>
    </div>

    <table>
        <thead>
            <tr><th>Earnings</th><th>Amount (KES)</th></tr>
        </thead>
        <tbody>
            <tr><td>Basic Salary</td><td>{{ number_format($payslip->payroll->basic_salary, 2) }}</td></tr>
            @foreach($payslip->earnings ?? [] as $label => $value)
                <tr><td>{{ $label }}</td><td>{{ number_format($value, 2) }}</td></tr>
            @endforeach
        </tbody>
    </table>

    <table>
        <thead>
            <tr><th>Deductions</th><th>Amount (KES)</th></tr>
        </thead>
        <tbody>
            @foreach($payslip->deductions ?? [] as $label => $value)
                <tr><td>{{ $label }}</td><td>{{ number_format($value, 2) }}</td></tr>
            @endforeach
            <tr>
                <td><strong>Total Deductions</strong></td>
                <td><strong>{{ number_format($payslip->payroll->total_deductions, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <h3>Net Pay: <span style="border-bottom: 1px solid #000;">KES {{ number_format($payslip->payroll->net_salary, 2) }}</span></h3>

    @if ($payslip->notes)
        <p><strong>Notes:</strong> {{ $payslip->notes }}</p>
    @endif

    <div class="footer">
        Generated by ClinicEMR | {{ now()->format('M d, Y H:i') }}
    </div>
</body>
</html>
