{{-- filepath: resources/views/auth/forgot-password.blade.php --}}
@extends('layouts.guest')

@section('body-class', 'login-page')

@section('content')
    <div class="login-header box-shadow mb-4">
    
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7 d-none d-md-block">
                    <img src="{{ asset('vendors/images/login-page-img.png') }}" alt="" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-success">{{ __('Forgot Password') }}</h2>
                            <p class="text-center text-muted mb-4">
                                {{ __('Enter your email to receive a password reset link') }}
                            </p>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success mb-4" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="input-group custom mb-3">
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    placeholder="{{ __('Email') }}"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="text-center mt-4">
                            <a href="{{ route('login') }}" class="text-success font-weight-bold">
                                {{ __('Back to login') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection