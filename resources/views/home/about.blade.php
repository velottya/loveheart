@extends('home.layout')
@section('title', 'About Us')
@section('content')
    <br><br>
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="section-title"><br>
                <h2>About Us</h2>
                <p>Welcome to "LoveHeart", a website dedicated to helping people detect heart disease early.</p>
            </div>

            <div class="row">
                <div class="col-lg-6" data-aos="fade-right">
                    <img src="/home/img/about.png" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content" style="text-align: justify;" data-aos="fade-left"> <br><br><br>
                    <h3 style="text-align: center">Heart Disease Detection Using LoveHeart.</h3><br>
                    <p>
                        We understand that early detection is critical in preventing the risk of heart attack and other
                        heart diseases.
                        Therefore, we built the website "LoveHeart" which uses a special algorithm to detect heart disease
                        based on several medically proven risk factors.
                    </p>
                    <p class="fst-italic">
                        The algorithm we use on "LoveHeart" has been tested and validated by health experts and data
                        scientists.
                        We also make constant updates and improvements to our algorithms, so that we can provide more
                        accurate and reliable results to our users.
                    </p>
                    <p>
                        We understand that heart health issues are very important, which is why we also work closely with
                        doctors and health professionals in developing our algorithms.
                        This ensures that we provide the best and most accurate results for detecting heart disease.
                    </p>
                    <p>
                        We believe that by using "LoveHeart", people can take appropriate measures to maintain their heart
                        health.
                        We hope our website can be a useful source of information and help for you and your family. Thank
                        you for using "LoveHeart".
                    </p>
                </div>
            </div>

        </div>
    </section><!-- End About Us Section -->
@endsection
