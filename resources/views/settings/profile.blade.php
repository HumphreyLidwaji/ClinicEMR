@extends('layouts.app')

@section('title', __('Update Password'))

@section('content')

<!-- Page Header -->
<div class="mb-4">
    <h1 class="h4 text-primary mb-1">{{ __('Security Settings') }}</h1>
    <p class="text-muted mb-0">{{ __('Change your account password below') }}</p>
</div>

<div class="row">

    <!-- Password Reset Form -->
    <div class="col-md-9">
        <div class="card box-shadow border-radius-10 mb-4">
            <div class="card-body">
                <h5 class="mb-3 text-primary">{{ __('Change Password') }}</h5>

                {{-- Success Message --}}
                @if(session('password_success'))
                    <div class="alert alert-success">{{ session('password_success') }}</div>
                @endif

                {{-- Global Validation Errors (if any unhandled field error) --}}
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

                <!-- Password Update Form -->
                <form action="{{ route('settings.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Current Password -->
                    <div class="mb-3">
                        <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                        <input id="current_password" type="password"
                               name="current_password"
                               class="form-control @error('current_password') is-invalid @enderror"
                               required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('New Password') }}</label>
                        <input id="password" type="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm New Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">{{ __('Confirm New Password') }}</label>
                        <input id="password_confirmation" type="password"
                               name="password_confirmation"
                               class="form-control @error('password_confirmation') is-invalid @enderror"
                               required>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-warning">{{ __('Update Password') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
