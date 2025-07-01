
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Roles & Permissions Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-primary text-white">Create New Role</div>
                <div class="card-body">
                    <form action="{{ route('roles_permissions.storeRole') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" placeholder="Role Name" required>
                            <button class="btn btn-primary">Create Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-secondary text-white">Create New Permission</div>
                <div class="card-body">
                    <form action="{{ route('roles_permissions.storePermission') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" placeholder="Permission Name" required>
                            <button class="btn btn-secondary">Create Permission</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-info text-dark">Assign Permission to Role</div>
        <div class="card-body">
            <form action="{{ route('roles_permissions.assignPermission') }}" method="POST">
                @csrf
                <div class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <select name="role_id" class="form-select select2" required>
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="permission_id" class="form-select select2" required>
                            <option value="">Select Permission</option>
                            @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success w-100">Assign</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-info text-dark">Assign Role to User</div>
        <div class="card-body">
            <form action="{{ route('roles_permissions.assignRole') }}" method="POST">
                @csrf
                <div class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <select name="user_id" class="form-select select2" required>
                            <option value="">Select User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="role_id" class="form-select select2" required>
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-info w-100">Assign</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Roles & Their Permissions</h5>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($roles as $role)
                    <li class="list-group-item">
                        <strong>{{ $role->name }}</strong>
                        <ul class="mb-0">
                            @forelse($role->permissions as $perm)
                                <li>{{ $perm->name }}</li>
                            @empty
                                <li class="text-muted">No permissions assigned.</li>
                            @endforelse
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%',
            placeholder: 'Select an option',
            allowClear: true
        });
    });
</script>
@endpush