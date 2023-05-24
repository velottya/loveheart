@extends('auth.layout')
@section('title', 'Reset Password')
@section('content')

    <div class="container">
        <div class="form-container">
            <div class="signin-signup">
                <form method="POST" action="{{ route('password.reset.submit') }}">
                    @csrf
                    <h2 class="title">{{ __('Reset Password') }}</h2>
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $email ?? old('email') }}" placeholder="Email" required
                            autocomplete="email" autofocus>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" placeholder="New Password" required autocomplete="new-password">
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            placeholder="New Password Confirmation" required autocomplete="new-password">
                    </div>
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>LoveHeart</h3>
                    <p>
                        Forgot Your Password? Let's Fill the Form and Log in Again with Your New Password!
                    </p>
                </div>
                <img src="/register/img/si5.png" class="image" alt="" />
            </div>
        </div>
    </div>

@endsection
