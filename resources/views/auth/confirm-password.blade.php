{{-- filepath: resources/views/auth/confirm-password.blade.php --}}
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
                            <h2 class="text-center text-primary">{{ __('Confirm Password') }}</h2>
                            <p class="text-center text-muted mb-4">
                                {{ __('Please confirm your password before continuing.') }}
                            </p>
                        </div>
                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf
                            <div class="input-group custom mb-3">
                                <input
                                    type="password"
                                    name="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    placeholder="{{ __('Password') }}"
                                    required
                                    autofocus
                                />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        {{ __('Confirm Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="text-center mt-4">
                            <a href="{{ route('password.request') }}" class="text-primary font-weight-bold">
                                {{ __('Forgot your password?') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection