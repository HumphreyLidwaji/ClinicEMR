{{-- filepath: resources/views/auth/reset-password.blade.php --}}
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
                            <h2 class="text-center text-success">{{ __('Reset Password') }}</h2>
                            <p class="text-center text-muted mb-4">
                                {{ __('Enter your email and new password below.') }}
                            </p>
                        </div>
                        <form method="POST" action="{{ route('password.store') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ request()->route('token') }}">
                            <div class="input-group custom mb-3">
                                <input
                                    type="email"
                                    name="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    placeholder="{{ __('Email') }}"
                                    value="{{ old('email', request('email')) }}"
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
                            <div class="input-group custom mb-3">
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    placeholder="{{ __('Password') }}"
                                    required
                                />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="input-group custom mb-3">
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control form-control-lg"
                                    placeholder="{{ __('Confirm Password') }}"
                                    required
                                />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">
                                        {{ __('Reset Password') }}
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