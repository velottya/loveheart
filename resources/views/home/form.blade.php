@extends('home.layout')
@section('title', 'Diagnostic Form')
@section('content')
    <br><br>
    <div class="container mt-5 pt-5 mb-5" data-aos="fade-up">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-danger">
                <h4 class="card-title text-white text-center mt-2">LoveHeart Diagnostic Form</h4>
                <p class="card-title text-white text-center">
                    Enter the form according to the conditions you are experiencing
                </p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form id="form" action="{{ route('history') }}" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <div class="form-group row">
                                        <div class="col-md-4 ">
                                            <label for="name">Name </label>
                                        </div>
                                        <div class="col-md-8">
                                            <input class="form-control  @error('name') is-invalid @enderror " id="name"
                                                name="name" type="text" placeholder="Input Your Name"
                                                aria-label="default input example" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-4">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="age">Age </label>
                                        </div>
                                        <div class="col-md-8">
                                            <input class="form-control @error('age') is-invalid @enderror " id="age"
                                                name="age" type="number" placeholder="Input Your Age"
                                                aria-label="default input example" value="{{ old('age') }}">
                                            @error('age')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-4">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="sex">Sex </label>
                                        </div>
                                        <div class="col-md-8">
                                            <input class="form-check-input" type="radio" name="sex" id="male"
                                                value="M" {{ old('sex') == 'M' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="male">
                                                Male
                                            </label>
                                            <input class="form-check-input" type="radio" name="sex" id="female"
                                                value="F" {{ old('sex') == 'F' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="female">
                                                Female
                                            </label>
                                            @error('sex')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-4">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="RBP">Resting Blood Pressure</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input class="form-control @error('RBP') is-invalid @enderror " id="RBP"
                                                name="RBP" type="number"
                                                placeholder="Input Your Resting Blood Pressure"
                                                aria-label="default input example" value="{{ old('RBP') }}">
                                            @error('RBP')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-4">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="MHR">Maximum Heart Rate</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input class="form-control @error('MHR') is-invalid @enderror " id="MHR"
                                                name="MHR" type="number" placeholder="Input Your Maximum Heart Rate"
                                                aria-label="default input example" value="{{ old('MHR') }}">
                                            @error('MHR')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-4">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="CL">Cholesterol Levels</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input class="form-control @error('CL') is-invalid @enderror " id="CL"
                                                name="CL" type="number" placeholder="Input Your Cholesterol Levels"
                                                aria-label="default input example" value="{{ old('CL') }}">
                                            @error('CL')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-4">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="tanggal">Date </label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" id="date" value="<?= date('Y-m-d') ?>" readonly
                                                name="date" class="form-control" aria-label="default input example">
                                            @error('date')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <center>
                <div class="col col-6">
                    <div class="mt-3 mb-3">
                        <button class="btn btn-outline-danger btn-lg" name="submit" type="submit">Diagnose</button>
                        <button class="btn btn-outline-danger btn-lg" name="kirim" type="reset">Reset</button>
                    </div>
                </div>
            </center>
        </div>
        </form>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
@endsection
