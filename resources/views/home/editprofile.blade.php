@extends('home.layout')
@section('title', 'Edit User Profile')
@section('content')
    <br><br>
    <div class="container rounded bg-white mt-5 mb-5 pt-5" data-aos="fade-up">
        <div class="card border-0 shadow">
            <div class="card-body p-5">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div>
                            <h4 class="text-center">Edit Profile</h4>
                            <p class="text-center">For the security of your account, please do not share your personal
                                information with others.
                            </p>
                        </div>
                        <hr>
                        <div class="col-md-4 border-right">
                            <div class="d-flex flex-column align-items-center text-center"><img class="rounded-circle mt-5"
                                    width="150px" src="/profile/{{ $user->image }}">
                                <span class="font-weight-bold"></span>
                            </div>
                            <div class="col-md-4 mt-2 input-group flex-nowrap">
                                <input class="form-control input @error('image') is-invalid @enderror" type="file"
                                    name="image" id="image">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8 border-right">
                            <div class="p-3 py-5">
                                <div class="row mt-2">
                                    <div class="col-md-12"><label class="labels">Full Name</label>
                                        <input type="text"
                                            class="form-control input @error('fullname') is-invalid @enderror "
                                            name="fullname" id="fullname" value="{{ $user->fullname }}" required>
                                        @error('fullname')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12"><label class="labels">Username</label>
                                        <input type="text"
                                            class="form-control input @error('username') is-invalid @enderror "
                                            name="username" id="username" value="{{ $user->username }}" required>
                                        @error('username')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12"><label class="labels">Email</label>
                                        <input type="email"
                                            class="form-control input @error('email') is-invalid @enderror " name="email"
                                            id="email" value="{{ $user->email }}" readonly>
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('change.password.form') }}" class="btn btn-outline-dark">Change Password</a>
                        </div>
                        <div class="mt-2 mb-2 text-center">
                            <input class="btn btn-outline-danger" type="submit" value="Save Profile">
                            <a href="{{ route('profile.show') }}" class="btn btn-outline-dark">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection
