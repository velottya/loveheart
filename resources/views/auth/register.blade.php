@extends('auth.layout')
@section('title', 'Register')
@section('content')

    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="{{ route('register.process') }}" method="POST" class="">
                    @csrf
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                    @error('username')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="fullname" placeholder="Fullname" required>
                    </div>
                    @error('fullname')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Confirm Password" required>
                    </div>
                    @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <input type="submit" class="btn" value="Sign up">
                </form>

                {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </div>
                @endif --}}
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>One of us ?</h3>
                    <p>
                        Already Have an Account? Reach Everything There Is!
                    </p>
                    <a href="/login">
                        <button class="btn transparent">
                            Log In
                        </button>
                    </a>
                </div>
                <img src="register/img/si2.png" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="register/app.js"></script>

@endsection
