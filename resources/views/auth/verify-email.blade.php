{{-- filepath: resources/views/auth/verify-email.blade.php --}}
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
                            <h2 class="text-center text-primary">{{ __('Verify Your Email Address') }}</h2>
                            <p class="text-center text-muted mb-4">
                                {{ __('Before proceeding, please check your email for a verification link.') }}<br>
                                {{ __('If you did not receive the email, you can request another below.') }}
                            </p>
                        </div>
                        @if (session('status') === 'verification-link-sent')
                            <div class="alert alert-success mb-4" role="alert">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('verification.store') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                {{ __('Resend Verification Email') }}
                            </button>
                        </form>
                        <div class="text-center mt-4">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link text-primary font-weight-bold">
                                    {{ __('Log out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection