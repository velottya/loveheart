@extends('home.layout')
@section('title', 'Diagnostic Result')
@section('content')
    <br><br>
    <div class="container round bg-white mt-5 mb-5 p-5" data-aos="fade-up">
        <div class="card border-0 shadow">
            <div class="card-body p-5 text-center">
                <h4 class="card-title text-center">Diagnostic History</h4>
                <p class="card-title text-center">This table displays your history of diagnostic using LoveHeart</p>
                <hr>
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr class="align-middle">
                                <th scope="col">Date Checkup</th>
                                <th scope="col">Name</th>
                                <th scope="col">Age</th>
                                <th scope="col">Sex</th>
                                <th scope="col">Resting Blood Pressure</th>
                                <th scope="col">Maximum Heart Rate</th>
                                <th scope="col">Cholesterol Levels</th>
                                <th scope="col">Classification</th>
                                <th scope="col">Percentation</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($FormDiagnosis as $form)
                                <tr class="align-middle">
                                    <td>{{ $form->date }}</td>
                                    <td>{{ $form->name }}</td>
                                    <td>{{ $form->age }}</td>
                                    <td>{{ $form->sex == 'M' ? 'Male' : 'Female' }}</td>
                                    <td>{{ $form->RBP }}</td>
                                    <td>{{ $form->MHR }}</td>
                                    <td>{{ $form->CL }}</td>
                                    <td>{{ $form->result == 0 ? 'No Risk of Heart Disease' : 'Risk of Heart Disease' }}</td>
                                    <td>{{ number_format($form->percent, 2) }} %</td>
                                    <td>
                                        <form action="{{ route('destroy', $form->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="10" class="text-center">No Data</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
