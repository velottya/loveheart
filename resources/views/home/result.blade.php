@extends('home.layout')
@section('title', 'Diagnostic Result')
@section('content')
    <br><br>
    <div class="container mt-5 pt-5 mb-5" data-aos="fade-up">
        <div class="card border-0 shadow-lg">
            <div class="card-body p-5">
                <h4 class="card-title text-center">Diagnosis Result</h4>
                <p class="card-title text-center">This is the result of a diagnosis based on previous data input</p>
                <hr>
                <div class="mb-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">General Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="col-lg-4 col-md-4 text-center">Name</th>
                                <td class="col-lg-8 col-md-8 text-center">{{ $ResultLatest->name }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-4 col-md-4 text-center">Age</th>
                                <td class="col-lg-8 col-md-8 text-center">{{ $ResultLatest->age }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-4 col-md-4 text-center">Sex</th>
                                <td class="col-lg-8 col-md-8 text-center">
                                    {{ $ResultLatest->sex == 'M' ? 'Male' : 'Female' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mb-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="3" class="text-center">Your Current State</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-center">Resting Blood Pressure</th>
                                <th class="text-center">Maximum Heart Rate</th>
                                <th class="text-center">Cholesterol Levels</th>
                            </tr>
                            <tr>
                                <td class="text-center">{{ $ResultLatest->RBP }}</td>
                                <td class="text-center">{{ $ResultLatest->MHR }}</td>
                                <td class="text-center">{{ $ResultLatest->CL }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mb-5 mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2" class="text-center">Diagnosis Results Based on Your Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-center">Classifier</th>
                                <th class="text-center">Percentage</th>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    {{ $ResultLatest->result == 0 ? 'No Risk of Heart Disease' : 'Risk of Heart Disease' }}
                                </td>
                                <td class="text-center">{{ number_format($ResultLatest->percent, 2) }} %</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mb-3 mt-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">Our Suggestion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">Based on the results of your heart health check, it is recommended
                                    that you make lifestyle changes such as increasing physical activity, maintaining a
                                    healthy diet, and reducing stress to prevent a greater risk of heart disease. If there
                                    are further problems, contact a doctor immediately.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
                <center>
                    <div class="mt-4">
                        <a href="{{ route('form') }}" class="btn btn-outline-dark btn-lg">Back</a>
                    </div>
                </center>
            </div>
        </div>
    </div>
@endsection
