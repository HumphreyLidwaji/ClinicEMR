@extends('layouts.app')

@section('content')
    <h2>Database Backups</h2>
    <a href="{{ route('backups.create') }}" class="btn btn-primary">Create Backup</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>File</th>
                <th>Created At</th>
                <th>Restore status</th>
                <th>Restore at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($backups as $backup)
                <tr>
                    <td>{{ $backup->file_name }}</td>
                    <td>{{ $backup->created_at }}</td>
                    <td>{{ $backup->restore_status ?? 'N/A' }}</td>
<td>{{ $backup->restored_at ?? 'Never' }}</td>

                    <td>
                        <a href="{{ route('backups.restore', $backup->id) }}" class="btn btn-sm btn-warning">Restore</a>
                        <a href="{{ Storage::url($backup->file_path) }}" class="btn btn-sm btn-success">Download</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
