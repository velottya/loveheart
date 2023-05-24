@extends('home.layout')
@section('title', 'Change Password')
@section('content')
    <br><br>
    <div class="container mt-5 pt-5 mb-5" data-aos="fade-up">
        <div class="card border-0 shadow">
            <div class="card-header bg-danger">
                <h4 class="card-title text-white text-center mt-2">Change Password Form</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form method="POST" action="{{ route('change.password') }}">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <div class="form-group row">
                                        <div class="col-md-5">
                                            <label for="password"
                                                class="col-form-label text-md-right">{{ __('Old Password') }}
                                            </label>
                                        </div>
                                        <div class="col-md-7">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autofocus>
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-4">
                                    <div class="form-group row">
                                        <div class="col-md-5">
                                            <label for="new_password"
                                                class="col-form-label text-md-right">{{ __('New Password') }}
                                            </label>
                                        </div>
                                        <div class="col-md-7">
                                            <input id="new_password" type="password"
                                                class="form-control @error('new_password') is-invalid @enderror"
                                                name="new_password" required>
                                            @error('new_password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-4">
                                    <div class="form-group row">
                                        <div class="col-md-5">
                                            <label for="new_password_confirmation"
                                                class="col-form-label text-md-right">{{ __('Confirm New Password') }}</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input id="new_password_confirmation" type="password" class="form-control"
                                                name="new_password_confirmation" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-12">
                            <div class="mt-4 mb-3 text-center">
                                <button class="btn btn-outline-danger" name="submit" type="submit">Change
                                    Password</button>
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-dark">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
