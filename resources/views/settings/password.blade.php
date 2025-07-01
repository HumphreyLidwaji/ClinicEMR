@extends('layouts.app')

@section('title', __('Update Password'))

@section('content')
<!-- Breadcrumbs -->
<div class="mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white px-0 py-2 mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('settings.profile.edit') }}">{{ __('Profile') }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Password') }}</li>
        </ol>
    </nav>
</div>

<!-- Page Header -->
<div class="mb-4">
    <h1 class="h4 text-primary mb-1">{{ __('Update Password') }}</h1>
    <p class="text-muted mb-0">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
</div>

<div class="row">
    <!-- Sidebar Navigation -->
    <div class="col-md-3 mb-4">
        <nav class="card bg-white box-shadow border-radius-10">
            <ul class="list-group list-group-flush">
                <li class="list-group-item p-0 border-0">
                    <a href="{{ route('settings.profile.edit') }}"
                       class="d-block px-4 py-3 {{ request()->routeIs('settings.profile.*') ? 'active fw-bold text-primary' : 'text-dark' }}">
                        {{ __('Profile') }}
                    </a>
                </li>
                <li class="list-group-item p-0 border-0">
                    <a href="{{ route('settings.password.edit') }}"
                       class="d-block px-4 py-3 {{ request()->routeIs('settings.password.*') ? 'active fw-bold text-primary' : 'text-dark' }}">
                        {{ __('Password') }}
                    </a>
                </li>
            
            </ul>
        </nav>
    </div>

    <!-- Password Update Form -->
    <div class="col-md-9">
        <div class="card box-shadow border-radius-10 mb-4">
            <div class="card-body">

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                {{-- Error Message --}}
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                {{-- Validation Errors --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>{{ __('Please fix the following errors:') }}</strong>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('settings.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Current Password -->
                    <div class="mb-3">
                        <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                        <input id="current_password" name="current_password" type="password"
                               class="form-control @error('current_password') is-invalid @enderror" required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('New Password') }}</label>
                        <input id="password" name="password" type="password"
                               class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                               class="form-control" required>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary">{{ __('Update Password') }}</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
