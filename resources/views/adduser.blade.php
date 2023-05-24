@extends('master')
@section('title', 'Edit User Tes Data')
@section('content')
    <section class="is-hero-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <h1 class="title">
                Add User
            </h1>
        </div>
    </section>
    <div class="card-content">
        <form action="{{ route('admin.adduser') }}" method="POST">
            @csrf
            <div class="field">
                <label class="label">Fullame</label>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input @error('fullname') is-invalid @enderror " id="fullname" name="fullname"
                                type="text" placeholder="Fullname" aria-label="default input example">
                            @error('fullname')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="field">
                <label class="label">Username</label>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input @error('username') is-invalid @enderror " id="username" name="username"
                                type="text" placeholder="Username" aria-label="default input example">
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="field">
                <label class="label">Email</label>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input @error('email') is-invalid @enderror " id="email" name="email"
                                type="email" placeholder="Email" aria-label="default input example">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="field">
                <label class="label">Password</label>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input @error('password') is-invalid @enderror " id="password" name="password"
                                type="password" placeholder="Password" aria-label="default input example">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <center>
                <div class="">
                    <button class="button light" name="save" type="submit">Save</button>
                    <a href="{{ route('admin.userprofile') }}" class="button light">Back</a>
                </div>
            </center>
        </form>
    </div>
@endsection
