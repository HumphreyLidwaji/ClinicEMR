
{{-- resources/views/audit_logs/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Audit Logs')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Audit Logs</h4>
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Model</th>
                            <th>Model ID</th>
                            <th>Old Values</th>
                            <th>New Values</th>
                            <th>IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->created_at }}</td>
                            <td>{{ $log->user ? $log->user->name : 'System' }}</td>
                            <td><span class="badge bg-info text-dark">{{ $log->action }}</span></td>
                            <td>{{ class_basename($log->auditable_type) }}</td>
                            <td>{{ $log->auditable_id }}</td>
                            <td>
                                <pre class="mb-0 bg-light rounded p-2" style="max-width:300px; max-height:120px; overflow:auto;">{{ $log->old_values }}</pre>
                            </td>
                            <td>
                                <pre class="mb-0 bg-light rounded p-2" style="max-width:300px; max-height:120px; overflow:auto;">{{ $log->new_values }}</pre>
                            </td>
                            <td>{{ $log->ip_address }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No audit logs found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection