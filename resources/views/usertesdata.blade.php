@extends('master')
@section('title', 'User Tes Data')
@section('content')
    <section class="is-hero-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <h1 class="title">
                Diagnostic Result
            </h1>
        </div>
    </section>
    <section class="section main-section">
        <div class="card">
            <div class="card-content">
                <table>
                    <thead>
                        <tr>
                            <th>Number</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Sex</th>
                            <th>Resting Blood Pressure</th>
                            <th>Maximum Heart Rate</th>
                            <th>Cholesterol Levels</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($showUserDiagnostic as $form)
                            <tr>
                                <td data-label="Number">{{ $loop->iteration }}</td>
                                <td data-label="Name">{{ $form->name }}</td>
                                <td data-label="Age">{{ $form->age }}</td>
                                <td data-label="Sex">{{ $form->sex == 'M' ? 'Male' : 'Female' }}</td>
                                <td data-label="Resting Blood Pressure">{{ $form->RBP }}</td>
                                <td data-label="Resting Blood Pressure">{{ $form->MHR }}</td>
                                <td data-label="Maximum Heart Rate"> {{ $form->CL }}</td>
                                <td data-label="Action">
                                    <div class="buttons nowrap">
                                        <form
                                            action="{{ route('admin.userresult.destroy', ['editusertesdata' => $form->id]) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="button small red --jb-modal" data-target="sample-modal"
                                                type="submit" class="button">
                                                <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <td data-label="Information">No Data</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if ($showUserDiagnostic->lastPage() > 1)
            <div class="card">
                <div class="card-content">
                    <div class="pagination">
                        <div class="flex items-center justify-between">
                            <div class="buttons">
                                <div class="{{ $showUserDiagnostic->currentPage() == 1 ? ' disabled' : '' }}">
                                    <a href="{{ $showUserDiagnostic->url(1) }}">
                                        <button type="button" class="button">1</button>
                                    </a>
                                </div>
                                @for ($i = 2; $i <= $showUserDiagnostic->lastPage(); $i++)
                                    <div class="{{ $showUserDiagnostic->currentPage() == $i ? ' active' : '' }}">
                                        <a href="{{ $showUserDiagnostic->url($i) }}">
                                            <button type="button" class="button">{{ $i }}</button>
                                        </a>
                                    </div>
                                @endfor
                            </div>
                            <small>Page {{ $showUserDiagnostic->currentPage() }} of
                                {{ $showUserDiagnostic->lastPage() }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection
