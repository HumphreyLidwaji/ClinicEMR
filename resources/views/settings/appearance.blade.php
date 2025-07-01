@extends('layouts.app')

@section('title', __('Appearance'))

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
                <li class="breadcrumb-item active" aria-current="page">{{ __('Appearance') }}</li>
            </ol>
        </nav>
    </div>

    <!-- Page Title -->
    <div class="mb-4">
        <h1 class="h4 text-primary mb-1">{{ __('Appearance') }}</h1>
        <p class="text-muted mb-0">{{ __('Update the appearance settings for your account') }}</p>
    </div>

    <div class="row">
        <!-- Sidebar Navigation -->
        <div class="col-md-3 mb-4">
            @include('settings.partials.navigation')
        </div>

        <!-- Appearance Content -->
        <div class="col-md-9">
            <div class="card-box bg-white box-shadow border-radius-10 mb-4">
                <div class="pd-20">
                    <div class="mb-3">
                        <label for="theme" class="form-label">{{ __('Theme') }}</label>
                        <div class="btn-group" role="group" aria-label="Theme selection">
                            <button type="button" onclick="setAppearance('light')" class="btn btn-outline-primary">{{ __('Light') }}</button>
                            <button type="button" onclick="setAppearance('dark')" class="btn btn-outline-primary">{{ __('Dark') }}</button>
                            <button type="button" onclick="setAppearance('system')" class="btn btn-outline-primary">{{ __('System') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setAppearance(theme) {
            // Example: Save theme to localStorage or send to server
            localStorage.setItem('theme', theme);
            // Optionally, trigger theme change in your app
            // location.reload();
        }
    </script>
@endsection