@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Backup & Restore</h1>

    <form action="{{ route('backup.create') }}" method="POST" class="mb-4">
        @csrf
        <button class="btn btn-success">Create Backup</button>
    </form>

    <h4>Restore Backup</h4>
    <form action="{{ route('backup.restore') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="file" name="backup_file" class="form-control" required>
        </div>
        <button class="btn btn-warning">Restore</button>
    </form>

    <hr>

    <h4 class="mt-4">Available Backups</h4>
    <ul class="list-group">
        @foreach($backups as $backup)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $backup }}
            <a href="{{ route('backup.download', $backup) }}" class="btn btn-sm btn-outline-primary">Download</a>
        </li>
        @endforeach
    </ul>
</div>
@endsection
