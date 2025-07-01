<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payslip</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td, th { border: 1px solid #ccc; padding: 8px; }
    </style>
</head>
<body>
    <h2>Payslip</h2>

    <p><strong>Employee:</strong> {{ $payslip->payroll->employee->first_name }} {{ $payslip->payroll->employee->last_name }}</p>
    <p><strong>Month:</strong> {{ $payslip->payroll->pay_month }}</p>

    <table>
        <thead><tr><th>Earnings</th><th>Amount</th></tr></thead>
        <tbody>
        @foreach($payslip->earnings ?? [] as $label => $value)
            <tr><td>{{ $label }}</td><td>{{ $value }}</td></tr>
        @endforeach
        <tr><td><strong>Basic</strong></td><td>{{ $payslip->payroll->basic_salary }}</td></tr>
        </tbody>
    </table>

    <table>
        <thead><tr><th>Deductions</th><th>Amount</th></tr></thead>
        <tbody>
        @foreach($payslip->deductions ?? [] as $label => $value)
            <tr><td>{{ $label }}</td><td>{{ $value }}</td></tr>
        @endforeach
        <tr><td><strong>Total</strong></td><td>{{ $payslip->payroll->total_deductions }}</td></tr>
        </tbody>
    </table>

    <h3>Net Pay: {{ $payslip->payroll->net_salary }}</h3>
</body>
</html>
