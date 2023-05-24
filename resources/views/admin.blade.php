@extends('master')
@section('title', 'Dashboard')
@section('content')
    <div id="app">
        <section class="is-hero-bar">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
                <h1 class="title">
                    Hello, {{ Auth::user()->fullname }} !
                </h1>
                <a href="/"><button class="button light">User Page</button></a>
            </div>
        </section>

        <section class="section main-section">
            <div class="grid gap-6 grid-cols-1 md:grid-cols-3 mb-6">
                <div class="card">
                    <div class="card-content">
                        <div class="flex items-center justify-between">
                            <div class="widget-label">
                                <h3>
                                    User Registered
                                </h3>
                                <h1>
                                    {{ $totalUser }}
                                </h1>
                            </div>
                            <span class="icon widget-icon text-green-500"><i
                                    class="mdi mdi-account-multiple mdi-48px"></i></span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="flex items-center justify-between">
                            <div class="widget-label">
                                <h3>
                                    Number of Dataset
                                </h3>
                                <h1>
                                    {{ $totalDataset }}
                                </h1>
                            </div>
                            <span class="icon widget-icon text-blue-500"><i
                                    class="mdi mdi-cart-outline mdi-48px"></i></span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <div class="flex items-center justify-between">
                            <div class="widget-label">
                                <h3>
                                    Total Diagnostic
                                </h3>
                                <h1>
                                    {{ $totalDiagnostic }}
                                </h1>
                            </div>
                            <span class="icon widget-icon text-red-500"><i class="mdi mdi-finance mdi-48px"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card has-table">
                <header class="card-header">
                    <p class="card-header-title">
                        <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                        Last User Log In
                    </p>
                </header>
                <div class="card-content">
                    <table>
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Last Log In</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($userLastLogin as $user)
                                <tr>
                                    <td data-label="Name">{{ $user->fullname }}</td>
                                    <td data-label="Company">{{ $user->username }}</td>
                                    <td data-label="City">{{ $user->email }}</td>
                                    <td data-label="Last Login">{{ $formattedLastLoggedInTime }}</td>
                                </tr>
                            @empty
                                <td data-label="Information">No User Logged In</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($userLastLogin->lastPage() > 1)
                <div class="card">
                    <div class="card-content">
                        <div class="pagination">
                            <div class="flex items-center justify-between">
                                <div class="buttons">
                                    <div class="{{ $userLastLogin->currentPage() == 1 ? ' disabled' : '' }}">
                                        <a href="{{ $userLastLogin->url(1) }}">
                                            <button type="button" class="button">1</button>
                                        </a>
                                    </div>
                                    @for ($i = 2; $i <= $userLastLogin->lastPage(); $i++)
                                        <div class="{{ $userLastLogin->currentPage() == $i ? ' active' : '' }}">
                                            <a href="{{ $userLastLogin->url($i) }}">
                                                <button type="button" class="button">{{ $i }}</button>
                                            </a>
                                        </div>
                                    @endfor
                                </div>
                                <small>Page {{ $userLastLogin->currentPage() }} of
                                    {{ $userLastLogin->lastPage() }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </section>
    </div>
@endsection
