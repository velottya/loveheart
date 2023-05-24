<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('/home/img/icon-tab.png') }}">
    <meta content="" name="description">
    <meta content="" name="keywords">


    <!-- Favicons -->
    {{-- <link href="/home/img/favicon.png" rel="icon"> --}}
    <link href="/home/img/icon-tab.png" rel="icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/home/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="/home/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="/home/vendor/aos/aos.css" rel="stylesheet">
    <link href="/home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/home/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/home/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/home/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/home/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/home/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <a href="/" class="logo me-auto"><img src="/home/img/logo.png" alt=""></a>
            <!-- Uncomment below if you prefer to use an image logo -->
            {{-- <h1 class="logo me-auto"><img src="" alt=""></h1> --}}

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto @if (Request::is('/')) active @endif"
                            href="/">Home</a></li>
                    <li><a class="nav-link scrollto @if (Request::is('about')) active @endif"
                            href="/about">About</a></li>
                    @if (Auth::check() && Auth::user()->role == 'admin')
                        <li><a class="nav-link scrollto" href="{{ route('admin.dashboard') }}">Back to Admin</a></li>
                    @endif
                    @guest
                        <li><a class="nav-link scrollto" href="{{ route('login') }}">Log In</a></li>
                    @endguest

                    @if (Auth::check() && Auth::user()->role == 'user')
                        <li><a class="nav-link scrollto @if (Request::is('service')) active @endif"
                                href="/service">Services</a></li>
                        <li class="dropdown"><a href="{{ route('profile.show') }}"><span>Account</span> <i
                                    class="dropdown"></i></a>
                            <ul>
                                <li>
                                    <a class="@if (Request::is('profiluser')) active @endif"
                                        href="{{ route('profile.show') }}">
                                        My Account
                                    </a>
                                </li>
                                <li>
                                    <a class="@if (Request::is('history')) active @endif" href="/history">
                                        History
                                    </a>
                                </li>
                                <li><a href="/logout">Logout</a></li>
                            </ul>
                    @endif
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
            <!-- .navbar -->
            @if (Auth::check() && Auth::user()->role == 'user')
                <a href="{{ route('form') }}" class="appointment-btn scrollto"><span class="d-none d-md-inline"></span>
                    Start Check</a>
            @endif

        </div>
    </header>

    <!-- End Header -->

    @section('content')
    @show

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6"><br><br><br>
                        <img src="/home/img/logo2.png" alt="" width="350">
                    </div>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-info">
                            {{-- <h3>LoveHeart</h3> --}}
                            <p>
                                LoveHeart Corp. <br>
                                Malang, Indonesia<br><br>
                                <strong>Phone:</strong> (0341) 551312<br>
                                <strong>Email:</strong> loveyourheart2023@gmail.com<br>
                            </p>
                            <div class="social-links mt-3">
                                <a href="https://twitter.com/UM_1954" class="twitter"><i class="bx bxl-twitter"></i></a>
                                <a href="https://www.facebook.com/Informasi.UM" class="facebook"><i
                                        class="bx bxl-facebook"></i></a>
                                <a href="https://www.instagram.com/universitasnegerimalang/" class="instagram"><i
                                        class="bx bxl-instagram"></i></a>
                                <a href="https://plus.google.com/+InfoUm" class="google-plus"><i
                                        class="bx bxl-skype"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="/">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="/about">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="/service">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="/termofservice">Terms of service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="/termofservice">Privacy policy</a></li>
                        </ul>
                    </div>

                    {{-- <div class="col-lg-5 col-md-12 footer-newsletter">
                        <h4>Reedem Coupon Code</h4>
                        <p>Please see on our social media page Reedemption Coupon Code to get rewards</p>
                        <form action="" method="post">
                            <input type="email" name="code"><input type="submit" value="Claim"> --}}
                    </form>
                </div>

            </div>
        </div>
        </div>

    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="/home/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="/home/vendor/aos/aos.js"></script>
    <script src="/home/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/home/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/home/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/home/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/home/js/main.js"></script>

</body>

</html>
