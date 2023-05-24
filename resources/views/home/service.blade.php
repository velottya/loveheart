@extends('home.layout')
@section('title', 'Services')
@section('content')
    <br><br>
    <!-- ======= Services Section ======= -->
    <section id="services" class="services services">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Services</h2>
                <p>We offer several services that you can use as a form of our dedication to heart patients.</p>
            </div> <br>

            <div class="row">
                <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon"><i class="fas fa-heartbeat"></i></div>
                    <h4 class="title"><a href="{{ route('form') }}">Heart Diagnosis</a></h4>
                    <p class="description" style="text-align: justify">
                        "LoveHeart" offers early detection of heart disease using a special algorithm that has been tested
                        and validated.
                        Users only need to fill in some information about their risk factors, such as age, gender, and
                        measure their blood pressure and cholesterol levels.
                        After that, the algorithm will provide detection results for possible heart disease and provide
                        suggestions for next steps.
                    </p>
                </div>
                <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
                    <div class="icon"><i class="fas fa-pills"></i></div>
                    <h4 class="title"><a href="{{ route('form') }}">Diagnosis Results</a></h4>
                    <p class="description" style="text-align: justify">
                        After the user fills in all the required information, "LoveHeart" will provide the detection results
                        for possible heart disease.
                        These results will be based on the risk factors that have been filled in by the user and the data
                        that has been measured.
                        The results of this detection cannot be considered a medical diagnosis, but can be an initial clue
                        to consult a doctor or health professional.
                    </p>
                </div>
                <div class="col-lg-4 col-md-12 icon-box text-center" data-aos="zoom-in" data-aos-delay="300">
                    <div class="icon"><i class="fas fa-hospital-user"></i></div>
                    <h4 class="title"><a href="{{ route('history') }}">Diagnosis History</a></h4>
                    <p class="description" style="text-align: justify">
                        After the user fills in all the required information, "LoveHeart" will provide the detection results
                        for possible heart disease.
                        These results will be based on the risk factors that have been filled in by the user and the data
                        that has been measured.
                        The results of this detection cannot be considered a medical diagnosis, but can be an initial clue
                        to consult a doctor or health professional.
                    </p>
                </div>
            </div> <br>

            <div class="section-title">
                <p>We hope that our service can help users monitor their heart health and prevent the risk of heart disease.
                    However, the detection results provided by the algorithm cannot be considered a medical diagnosis and we
                    advise users to consult
                    a doctor or healthcare professional for more accurate results. Thank you for using "LoveHeart" service!
                </p>
            </div>

        </div>
    </section><!-- End Services Section -->
@endsection
