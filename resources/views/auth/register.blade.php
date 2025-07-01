
@extends('layouts.guest')

@section('title', __('Register'))

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-white rounded-lg shadow-md border p-4 w-100" style="max-width: 400px;">
        <div class="text-center mb-4">
            <h1 class="h4 font-weight-bold text-dark">{{ __('Register') }}</h1>
            <p class="text-muted mt-1">
                {{ __('Enter your details below to create your account') }}
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Full Name Input -->
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Full Name') }}</label>
                <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       placeholder="{{ __('Full Name') }}" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <!-- Email Input -->
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       placeholder="your@email.com" value="{{ old('email') }}" required>
                @error('email')
                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <!-- Password Input -->
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="••••••••" required>
                @error('password')
                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <!-- Confirm Password Input -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"
                       placeholder="••••••••" required>
            </div>

            <!-- Register Button -->
            <button type="submit" class="btn btn-primary w-100">{{ __('Create Account') }}</button>
        </form>

        <!-- Login Link -->
        <div class="text-center mt-4">
            <p class="text-sm text-muted">
                {{ __('Already have an account?') }}
                <a href="{{ route('login') }}" class="text-primary font-weight-bold">{{ __('Sign in') }}</a>
            </p>
        </div>
    </div>
</div>
@endsection