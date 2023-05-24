@extends('home.layout')
@section('title', 'LoveHeart')
@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel"
            data-aos="fade-up">

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

            <div class="carousel-inner" role="listbox">

                <!-- Slide 1 -->
                <div class="carousel-item active" style="background-image: url(/home/img/a3.png)">
                    <div class="container">
                        <h2>Welcome to <span>LoveHeart</span></h2>
                        <p>Early detection of heart disease can save your life. Perform regular check-ups, one of which uses
                            a diagnosis using LoveHeart, and consult your doctor.</p>
                        <a href="/about" class="btn-get-started scrollto">Read More</a>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item" style="background-image: url(/home/img/a1.png)">
                    <div class="container">
                        <h2>Why Should <span>LoveHeart</span> ?</h2>
                        <p>LoveHeart uses a dataset of thousands of heart disease survey results and calculates it using an
                            algorithm to determine a likelihood based on an existing condition.</p>
                        <a href="/about" class="btn-get-started scrollto">Read More</a>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item" style="background-image: url(/home/img/a2.png)">
                    <div class="container">
                        <h2>How <span>LoveHeart</span> Detect It?</h2>
                        <p>LoveHeart uses an algorithm that can be used to detect heart disease by utilizing probability.
                            This approach involves the use of several risk factors, such as age, sex, blood pressure,
                            cholesterol levels.</p>
                        <a href="/about" class="btn-get-started scrollto">Read More</a>
                    </div>
                </div>

            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Featured Services Section ======= -->
        <section id="featured-services" class="featured-services">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                            <div class="icon"><i class="fas fa-heartbeat"></i></div>
                            <h4 class="title"><a href="{{ route('form') }}">Heart Diagnosis</a></h4>
                            <p class="description">Easy heart detection wherever and whenever you are without any
                                requirements</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                            <div class="icon"><i class="fas fa-pills"></i></div>
                            <h4 class="title"><a href="{{ route('form') }}">Diagnosis Results</a></h4>
                            <p class="description">Display the diagnosis results based on the data you entered with certain
                                algorithmic calculations</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon"><i class="fas fa-thermometer"></i></div>
                            <h4 class="title"><a href="{{ route('history') }}">Diagnosis History</a></h4>
                            <p class="description">See some of the results of the diagnosis you have made. You can also
                                delete your diagnosis data</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon"><i class="fas fa-dna"></i></div>
                            <h4 class="title"><a href="{{ route('profile.show') }}">Profile Access</a></h4>
                            <p class="description">View your account profile and account settings with just one touch that
                                makes it easy for you</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Featured Services Section -->

        <!-- ======= Frequently Asked Questioins Section ======= -->
        <section id="faq" class="faq section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Frequently Asked Questioins</h2>
                    <p>Welcome to LoveHeart - Heart Disease Diagnosis Website! Below are some frequently asked questions by
                        our users:</p>
                </div>

                <ul class="faq-list">

                    <li>
                        <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">What is "LoveHeart"?<i
                                class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                        <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                "LoveHeart" is a website built to help people detect heart disease early using a special
                                algorithm that has been tested and validated.
                            </p>
                        </div>
                    </li>

                    <li>
                        <div data-bs-toggle="collapse" class="collapsed question" href="#faq2">How to Use "LoveHeart"?<i
                                class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                        <div id="faq2" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                To use LoveHeart, you can follow these steps:
                            <ul>
                                a. Register or login to your LoveHeart account.
                            </ul>
                            <ul>
                                b. Fill in the diagnosis form provided according to the condition you are experiencing.
                            </ul>
                            <ul>
                                c. Based on your answer, our system will provide an initial assessment of your risk for
                                heart disease.
                            </ul>
                            <ul>
                                d. You will be given useful information about your risk factors and precautions you can
                                take.
                            </ul>
                            </p>
                        </div>
                    </li>

                    <li>
                        <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">How does the algorithm
                            work
                            in "LoveHeart"?<i class="bi bi-chevron-down icon-show"></i><i
                                class="bi bi-chevron-up icon-close"></i></div>
                        <div id="faq3" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                The algorithm in "LoveHeart" uses several risk factors to detect a person's likelihood of
                                developing heart disease. These risk factors include age, gender, blood pressure,
                                cholesterol levels, and others.
                            </p>
                        </div>
                    </li>

                    <li>
                        <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">Is the algorithm in
                            "LoveHeart" accurate?<i class="bi bi-chevron-down icon-show"></i><i
                                class="bi bi-chevron-up icon-close"></i></div>
                        <div id="faq4" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                The algorithms in "LoveHeart" have been tested and validated by health experts and data
                                scientists. However, the results provided by this algorithm cannot be considered a medical
                                diagnosis. For more accurate results, it is recommended to consult a doctor or health
                                professional.
                            </p>
                        </div>
                    </li>

                    <li>
                        <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">Is "LoveHeart" free?<i
                                class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                        <div id="faq5" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                Yes, "LoveHeart" is freely available for use by the community. However, users who want to
                                get more detailed results can opt for the paid option.
                            </p>
                        </div>
                    </li>

                    <li>
                        <div data-bs-toggle="collapse" href="#faq6" class="collapsed question">Will "LoveHeart" store
                            user data?<i class="bi bi-chevron-down icon-show"></i><i
                                class="bi bi-chevron-up icon-close"></i></div>
                        <div id="faq6" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                User data in "LoveHeart" will be stored securely and confidentially. We respect the privacy
                                of our users and will not share user data with third parties without user permission.
                            </p>
                        </div>
                    </li>

                    <li>
                        <div data-bs-toggle="collapse" href="#faq7" class="collapsed question">Can "LoveHeart" be used
                            by people who already have heart disease?<i class="bi bi-chevron-down icon-show"></i><i
                                class="bi bi-chevron-up icon-close"></i></div>
                        <div id="faq7" class="collapse" data-bs-parent=".faq-list">
                            <p>
                                "LoveHeart" is not intended to be used as a substitute for a medical diagnosis or medical
                                treatment prescribed by a doctor. However, this website can assist users in monitoring their
                                heart condition and provide advice on healthy lifestyle changes.
                            </p>
                        </div>
                    </li>

                </ul>

            </div>
        </section>
        <!-- End Frequently Asked Questioins Section -->
        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact" data-aos="fade-up">
            <div class="container">

                <div class="section-title">
                    <h2>Contact Us</h2>
                    <p>We'd love to hear from you! If you have any questions, suggestions or feedback about "LoveHeart",
                        please contact us using the information below.</p>
                </div>

            </div>

            <div class="container">

                <div class="row mt-5">

                    <div class="col-lg-6">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="info-box">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.345279219183!2d112.61557037580442!3d-7.963223992061553!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e788281bdd08839%3A0xc915f268bffa831f!2sUniversitas%20Negeri%20Malang!5e0!3m2!1sen!2sid!4v1682960420872!5m2!1sen!2sid"
                                        width="600" height="160" style="border:0;" allowfullscreen=""
                                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box mt-4">
                                    <a href="mailto:loveyourheart2023@gmail.com" target="_blank">
                                        <i class="bx bx-envelope"></i>
                                    </a>
                                    <h3>Email Us</h3>
                                    <p>loveyourheart2023@gmail.com</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box mt-4">
                                    <a href="tel:(0341) 551312">
                                        <i class="bx bx-phone-call"></i>
                                    </a>
                                    <h3>Call Us</h3>
                                    <p>(0341) 551312</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <form action="{{ route('contact') }}" method="post" role="form" class="php-email-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Your Name" required="">
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Your Email" required="">
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="subject" id="subject"
                                    placeholder="Subject" required="">
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="message" rows="7" placeholder="Message" required=""></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                            </div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>
                    </div>

                </div>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->
@endsection
