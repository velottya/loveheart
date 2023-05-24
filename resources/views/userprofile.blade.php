@extends('master')
@section('title', 'Data User Registered')
@section('content')
    <section class="is-hero-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <h1 class="title">
                Data User Registered
            </h1>
            <a href="{{ route('admin.adduser') }}"><button class="button light">Add Data</button></a>
        </div>
    </section>
    <section class="section main-section">
        <div class="card">
            <div class="card-content">
                <table>
                    <thead>
                        <tr>
                            <th>Fullname</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($showUser as $user)
                            <tr>
                                <td data-label="Name">{{ $user->fullname }}</td>
                                <td data-label="Username">{{ $user->username }}</td>
                                <td data-label="Email">{{ $user->email }}</td>
                                <td data-label="Action">
                                    <form action="{{ route('admin.userprofile.destroy', ['userdestroy' => $user->id]) }}"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="button small red --jb-modal" data-target="sample-modal"
                                            type="submit" class="button">
                                            <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <td data-label="Information">No Data</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($showUser->lastPage() > 1)
            <div class="card">
                <div class="card-content">
                    <div class="pagination">
                        <div class="flex items-center justify-between">
                            <div class="buttons">
                                <div class="{{ $showUser->currentPage() == 1 ? ' disabled' : '' }}">
                                    <a href="{{ $showUser->url(1) }}">
                                        <button type="button" class="button">1</button>
                                    </a>
                                </div>
                                @for ($i = 2; $i <= $showUser->lastPage(); $i++)
                                    <div class="{{ $showUser->currentPage() == $i ? ' active' : '' }}">
                                        <a href="{{ $showUser->url($i) }}">
                                            <button type="button" class="button">{{ $i }}</button>
                                        </a>
                                    </div>
                                @endfor
                            </div>
                            <small>Page {{ $showUser->currentPage() }} of {{ $showUser->lastPage() }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection
