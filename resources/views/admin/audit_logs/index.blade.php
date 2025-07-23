@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Audit Logs</h4>
            <div>
                <a href="{{ route('audit.logs.excel') }}" class="btn btn-light btn-sm mr-2">Export Excel</a>
                <a href="{{ route('audit.logs.pdf') }}" class="btn btn-light btn-sm">Export PDF</a>
            </div>
        </div>
        <div class="card-body">

            <form method="GET" class="form-inline mb-3">
                <select name="event" class="form-control mr-2">
                    <option value="">All Events</option>
                    <option value="created" {{ request('event') == 'created' ? 'selected' : '' }}>Created</option>
                    <option value="updated" {{ request('event') == 'updated' ? 'selected' : '' }}>Updated</option>
                    <option value="deleted" {{ request('event') == 'deleted' ? 'selected' : '' }}>Deleted</option>
                    <option value="login" {{ request('event') == 'login' ? 'selected' : '' }}>Login</option>
                    <option value="logout" {{ request('event') == 'logout' ? 'selected' : '' }}>Logout</option>
                </select>


                <input type="text" name="model" value="{{ request('model') }}" placeholder="Model (e.g. Patient)"
                    class="form-control mr-2">

                <button type="submit" class="btn btn-success">Filter</button>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-sm text-sm">
                    <thead class="bg-success text-white">
                        <tr>
                            <th>User</th>
                            <th>Model</th>
                            <th>Event</th>
                            <th>Old Values</th>
                            <th>New Values</th>
                            <th>When</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($audits as $audit)
                        <tr>
                            <td>{{ optional($audit->user)->name ?? 'System' }}</td>
                            <td>{{ class_basename($audit->auditable_type) }} #{{ $audit->auditable_id }}</td>
                            <td><span
                                    class="badge badge-{{ $audit->event === 'deleted' ? 'danger' : ($audit->event === 'updated' ? 'warning' : 'success') }}">
                                    {{ ucfirst($audit->event) }}
                                </span></td>
                            <td>
                                <pre
                                    class="m-0">{{ json_encode($audit->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            </td>
                            <td>
                                <pre
                                    class="m-0">{{ json_encode($audit->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            </td>
                            <td>{{ $audit->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No audit logs found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $audits->withQueryString()->links() }}
            </div>

        </div>
    </div>
</div>
@endsection
