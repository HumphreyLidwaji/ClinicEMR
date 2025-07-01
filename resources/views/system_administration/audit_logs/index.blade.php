@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Audit Logs</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>User</th>
                <th>Action</th>
                <th>Table</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->user->name ?? 'System' }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->auditable_type }}</td>
                <td>{{ $log->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
