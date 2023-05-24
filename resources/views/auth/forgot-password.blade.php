@extends('auth.layout')
@section('title', 'Forgot Password')
@section('content')

    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form method="POST" action="{{ route('password.forgot') }}">
                    @csrf
                    <div class="title">{{ __('Forgot Password') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.forgot') }}">
                            @csrf

                            <div class="input-field">
                                <i class="fas fa-user">
                                    <label for="email">{{ __('') }}</label>
                                </i>
                                <input id="email" type="email" placeholder="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn solid">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>

                        </form>

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
                    <a href="/login">
                        <button class="btn transparent">
                            Back to Log In
                        </button>
                    </a>
                </div>
                <img src="/register/img/si5.png" class="image" alt="" />
            </div>
        </div>
    </div>
    <script src="/register/app.js"></script>

@endsection
