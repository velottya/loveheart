@extends('master')
@section('title', 'Data Table')
@section('content')
    <section class="is-hero-bar">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
            <h1 class="title">
                Heart Failure Prediction Dataset
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
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Maximum Heart Rate</th>
                            <th>Resting Blood Pressure</th>
                            <th>Cholesterol Levels</th>
                            <th>Heart Disease</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($showDataset as $show)
                            <tr>
                                <td data-label="Number">{{ $show->id }}</td>
                                <td data-label="Age">{{ $show->age }}</td>
                                <td data-label="Gender">{{ $show->sex }}</td>
                                <td data-label="Maximum Heart Rate">{{ $show->MHR }}</td>
                                <td data-label="Resting Blood Pressure">{{ $show->RBP }}</td>
                                <td data-label="Cholesterol Levels">{{ $show->CL }}</td>
                                <td data-label="Result">{{ $show->result == 0 ? 'No' : 'Yes' }}</td>
                            </tr>
                        @empty
                            <td colspan="8" class="text-center">No Data</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                @if ($showDataset->lastPage() > 1)
                    <div class="pagination">
                        <div class="flex items-center justify-between">
                            <div class="buttons">
                                <div class="{{ $showDataset->currentPage() == 1 ? ' disabled' : '' }}">
                                    <a href="{{ $showDataset->url(1) }}">
                                        <button type="button" class="button">1</button>
                                    </a>
                                </div>
                                @for ($i = 2; $i <= $showDataset->lastPage(); $i++)
                                    <div class="{{ $showDataset->currentPage() == $i ? ' active' : '' }}">
                                        <a href="{{ $showDataset->url($i) }}">
                                            <button type="button" class="button">{{ $i }}</button>
                                        </a>
                                    </div>
                                @endfor
                            </div>
                            <small>Page {{ $showDataset->currentPage() }} of {{ $showDataset->lastPage() }}</small>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>


@endsection
