@extends('auth.layout')
@section('title', 'Log In')
@section('content')
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="" method="POST">
                    @csrf
                    <h2 class="title">Log in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" class="@error('username') is-invalid @enderror" placeholder="Username"
                            name="username" value="{{ old('username') }}" required>
                    </div>
                    @error('username')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" class="@error('password') is-invalid @enderror" placeholder="Password"
                            name="password" required>
                    </div>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <input type="submit" value="Login" class="btn solid" name="login" /> <br>
                    <a href="{{ route('password.forgot') }}" style="text-decoration: none">Forgot your Password?</a>
                </form>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Welcome to LoveHeart</h3>
                    <p>
                        Don't Have an Account?Let's Register First and Explore With Us!
                    </p>
                    <a href="/regist">
                        <button class="btn transparent">
                            Sign Up
                        </button>
                    </a>
                </div>
                <img src="register/img/si1.png" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="register/app.js"></script>
@endsection
