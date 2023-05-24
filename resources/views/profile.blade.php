@extends('master')
@section('title', 'Profile')
@section('content')
    <section class="is-hero-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <h1 class="title">
                Admin Profile
            </h1>
        </div>
    </section>
    <center>
        <section class="section main-section">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="field">
                            <img class="rounded-circle" width="150px" src="/profile/{{ $admin->image }}">
                            <span class="font-weight-bold"></span>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Username</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-label="Fullname">{{ $admin->fullname }}</td>
                                <td data-label="Username">{{ $admin->username }}</td>
                                <td data-label="Email">{{ $admin->email }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </center>
@endsection
