
{{-- filepath: resources/views/auth/login.blade.php --}}
@extends('layouts.guest')

@section('body-class', 'login-page')

@section('content')
    <div class="login-header box-shadow mb-4">

    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7 d-none d-md-block">
                    <img src="{{ asset('vendors/images/deskapp-logo.svg') }}" alt="" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-success">{{ __('Login to ClinicEMR') }}</h2>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="select-role mb-3">
                     
                            </div>
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
                            <div class="row pb-30">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="customCheck1"
                                            name="remember"
                                            {{ old('remember') ? 'checked' : '' }}
                                        />
                                        <label class="custom-control-label" for="customCheck1">
                                            {{ __('Remember me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="forgot-password text-right">
                                        <a href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <button type="submit" class="btn btn-success btn-lg btn-block">
                                            {{ __('Sign In') }}
                                        </button>
                                    </div>
                                    <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">
                                        {{ __('OR') }}
                                    </div>
                                    <div class="input-group mb-0">
                                        <a class="btn btn-outline-success btn-lg btn-block" href="{{ route('register') }}">
                                            {{ __('Register To Create Account') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection