<!DOCTYPE html>
<html>
<head>
    <title>Audit Logs</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 5px; vertical-align: top; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Audit Logs</h2>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Model</th>
                <th>Event</th>
                <th>Old Values</th>
                <th>New Values</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($audits as $audit)
            <tr>
                <td>{{ optional($audit->user)->name ?? 'System' }}</td>
                <td>{{ class_basename($audit->auditable_type) }}</td>
                <td>{{ $audit->event }}</td>
                <td>{{ json_encode($audit->old_values) }}</td>
                <td>{{ json_encode($audit->new_values) }}</td>
                <td>{{ $audit->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
