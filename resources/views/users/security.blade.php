@extends('layouts.app')

@section('content')
<div class="container">
    <h4>User Security Settings: {{ $user->name }}</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Reset Password --}}
    <div class="card mb-4">
        <div class="card-header">Reset Password</div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.resetPassword', $user) }}">
                @csrf
                <div class="mb-3">
                    <label>New Password</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <button class="btn btn-warning">Reset Password</button>
            </form>
        </div>
    </div>

    {{-- Block/Unblock User --}}
    <div class="card">
        <div class="card-header">Block / Unblock</div>
        <div class="card-body">
            <form method="POST" action="{{ route('users.toggleBlock', $user) }}">
                @csrf
                <p>Status: 
                    <strong class="{{ $user->is_blocked ? 'text-danger' : 'text-success' }}">
                        {{ $user->is_blocked ? 'Blocked' : 'Active' }}
                    </strong>
                </p>
                <button class="btn btn-{{ $user->is_blocked ? 'success' : 'danger' }}">
                    {{ $user->is_blocked ? 'Unblock User' : 'Block User' }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
