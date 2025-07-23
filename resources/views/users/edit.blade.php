@extends('layouts.app')

@section('content')
<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>There were some problems with your input:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <h4>{{ isset($user) ? 'Edit' : 'Create' }} User</h4>

    <form method="POST" action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}">
        @csrf
        @if(isset($user)) @method('PUT') @endif
    <div class="mb-3">
            <label>Employee</label>
            <select name="employee_id" class="form-control" required>
                <option value="">Select</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}"
                        {{ old('employee_id', $user->employee_id ?? '') == $employee->id ? 'selected' : '' }}>
                       {{ $employee->first_name }}-{{ $employee->last_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Name</label>
            <input name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input name="email" class="form-control" type="email" value="{{ old('email', $user->email ?? '') }}" required>
        </div>

    

        <div class="mb-3">
            <label>Role</label>
            <select name="role_id" class="form-control" required>
                <option value="">Select</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}"
                        {{ old('role_id', $user->roles->first()->id ?? '') == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        @if(!isset($user))
        <div class="mb-3">
            <label>Password</label>
            <input name="password" class="form-control" type="password" required>
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <input name="password_confirmation" class="form-control" type="password" required>
        </div>
        @endif

        <button class="btn btn-success">{{ isset($user) ? 'Update' : 'Create' }}</button>
    </form>
</div>
@endsection
