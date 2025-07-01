@extends('layouts.app')

@section('title', __('Profile'))

@section('content')
<!-- Breadcrumbs -->
<div class="mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white px-0 py-2 mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Profile') }}</li>
        </ol>
    </nav>
</div>

<!-- Page Header -->
<div class="mb-4">
    <h1 class="h4 text-primary mb-1">{{ __('Profile') }}</h1>
    <p class="text-muted mb-0">{{ __('Update your personal information') }}</p>
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
                <li class="list-group-item p-0 border-0">
                    <a href="{{ route('settings.appearance.edit') }}"
                       class="d-block px-4 py-3 {{ request()->routeIs('settings.appearance.*') ? 'active fw-bold text-primary' : 'text-dark' }}">
                        {{ __('Appearance') }}
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Profile Form Section -->
    <div class="col-md-9">
        <div class="card box-shadow border-radius-10 mb-4">
            <div class="card-body">

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
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

                <!-- Profile Form -->
                <form action="{{ route('settings.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" name="name" type="text"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" name="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
