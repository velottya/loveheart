@extends('home.layout')
@section('title', 'User Profile')
@section('content')
    <br><br>
    <div class="card border-0 shadow" data-aos="fade-up">
        <div class="container round bg-white mt-5 mb-5 p-5">
            <div class="card border-0 shadow">
                <div class="card-body p-5 text-center">
                    <h4 class="card-title text-center">My Profile</h4>
                    <p class="card-title text-center">Manage your profile information to control, protect and secure your
                        account</p>
                    <hr>
                    <div class="row">
                        <div class="border-right mb-4">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img class="rounded-circle" width="150px" src="/profile/{{ $user->image }}">
                                <span class="font-weight-bold"></span>
                            </div>
                        </div>
                        <hr>
                        <div class="col-lg-12 text-center">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3 col-lg-3">
                                            <p class="mb-0">Full Name</p>
                                        </div>
                                        <div class="col-sm-9 col-lg-9">
                                            <p class="text-muted mb-0">{{ $user->fullname }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3 col-lg-3">
                                            <p class="mb-0">Username</p>
                                        </div>
                                        <div class="col-sm-9 col-lg-9">
                                            <p class="text-muted mb-0">{{ $user->username }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3 col-lg-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9 col-lg-9">
                                            <p class="text-muted mb-0">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 mb-2 text-center">
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-danger btn-lg">Edit Profile</a>
                                <a href="/" class="btn btn-outline-dark btn-lg">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
