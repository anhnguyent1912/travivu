<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from webtendtheme.net/html/2024/ravelo/404.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Oct 2024 09:28:37 GMT -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Ravelo - Travel & Tour Booking HTML Template</title>
    <!-- Favicon Icon -->
    <link rel="shortcut icon" href="assets/images/logos/favicon.png" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">
    
     <!-- Flaticon -->
    <link rel="stylesheet" href="{{asset('clients/assets/css/flaticon.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('clients/assets/css/fontawesome-5.14.0.min.css')}}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('clients/assets/css/bootstrap.min.css')}}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{asset('clients/assets/css/magnific-popup.min.css')}}">
    <!-- Nice Select -->
    <link rel="stylesheet" href="{{asset('clients/assets/css/nice-select.min.css')}}">
    <!-- Animate -->
    <link rel="stylesheet" href="{{asset('clients/assets/css/aos.css')}}">
    <!-- Slick -->
    <link rel="stylesheet" href="{{asset('clients/assets/css/slick.min.css')}}">
    <!-- Main Style -->
    <link rel="stylesheet" href="{{asset('clients/assets/css/style.css')}}">
    
</head>
<body>
    <div class="page-wrapper">

        <!-- Preloader -->
        <div class="preloader"><div class="custom-loader"></div></div>

        <!-- main header -->
        <header class="main-header header-one">
            <!--Header-Upper-->
            <div class="header-upper bg-white py-30 rpy-0">
                <div class="container-fluid clearfix">

                    <div class="header-inner rel d-flex align-items-center">
                        <div class="logo-outer">
                            <div class="logo"><a href="index.html"><img src="assets/images/logos/logo-two.png" alt="Logo" title="Logo"></a></div>
                        </div>

                        <div class="nav-outer mx-lg-auto ps-xxl-5 clearfix">
                            <!-- Main Menu -->
                            <nav class="main-menu navbar-expand-lg">
                                <div class="navbar-header">
                                   <div class="mobile-logo">
                                       <a href="index.html">
                                            <img src="assets/images/logos/logo-two.png" alt="Logo" title="Logo">
                                       </a>
                                   </div>
                                   
                                    <!-- Toggle Button -->
                                    <button type="button" class="navbar-toggle" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>

                                <div class="navbar-collapse collapse clearfix">
                                   <ul class="navigation clearfix">
                                        <li class="current"><a href="{{ route('home')}}">Home</a></li>
                                        <li><a href="{{ route('about') }}">About</a></li>
                                        <li class="dropdown"><a href="#">Tours</a>
                                            <ul>
                                                <li><a href="{{ route('Tour') }}">Tour Sidebar</a></li>
                                                <li><a href="{{ route('tour-guide') }}">Tour Guide</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('destination') }}">Destinations</a></li>
                                        <li class="dropdown"><a href="#">Pages</a>
                                            <ul>
                                                <li><a href="#">faqs</a></li>
                                                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown"><a href="#">blog</a>
                                            <ul>
                                                <li><a href="#">blog List</a></li>
                                                <li><a href="#">blog details</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>

                            </nav>
                            <!-- Main Menu End-->
                        </div>
                        
                        <!-- Menu Button -->
                        <div class="menu-btns py-10">
                            <a href="contact.html" class="theme-btn style-two bgc-secondary">
                                <span data-hover="Book Now">Book Now</span>
                                <i class="fal fa-arrow-right"></i>
                            </a>
                            <!-- menu sidbar -->
                            <div class="menu-sidebar">
                                <button class="bg-transparent">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Header Upper-->
        </header>
       

        <!--Form Back Drop-->
        <div class="form-back-drop"></div>
        
        <!-- Hidden Sidebar -->
        <section class="hidden-bar">
            <div class="inner-box text-center">
                <div class="cross-icon"><span class="fa fa-times"></span></div>
                <div class="title">
                    <h4>Get Appointment</h4>
                </div>

                <!--Appointment Form-->
                <div class="appointment-form">
                    <form method="post" action="https://webtendtheme.net/html/2024/ravelo/contact.html">
                        <div class="form-group">
                            <input type="text" name="text" value="" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" value="" placeholder="Email Address" required>
                        </div>
                        <div class="form-group">
                            <textarea placeholder="Message" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="theme-btn style-two">
                                <span data-hover="Submit now">Submit now</span>
                                <i class="fal fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!--Social Icons-->
                <div class="social-style-one">
                    <a href="contact.html"><i class="fab fa-twitter"></i></a>
                    <a href="contact.html"><i class="fab fa-facebook-f"></i></a>
                    <a href="contact.html"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                </div>
            </div>
        </section>
        <!--End Hidden Sidebar -->
       
        
        <!-- 404 Error Area start -->
        <section class="error-area pt-70 pb-100 rel z-1">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-5 col-lg-6">
                        <div class="error-content rmb-55" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                            <h1>OPPS! </h1>
                            <div class="section-title mt-15 mb-25">
                                <h2>This Page Can’t be Found</h2>
                            </div>
                            <p>Best features to include on business landing page are those that quickly convey your value proposition, build trust, and encourage action. Here are six essential features</p>
                            <form class="newsletter-form mt-40 mb-50" action="#">
                                <input id="news-email" type="text" placeholder="Search keyword" required>
                                <button type="submit" class="theme-btn bgc-secondary style-two">
                                    <span data-hover="Search">Search</span>
                                    <i class="fal fa-arrow-right"></i>
                                </button>
                            </form>
                            <div class="keywords">
                                <a href="blog.html">Travel</a>
                                <a href="blog.html">Luxury Hotel</a>
                                <a href="blog.html">Indonesia</a>
                                <a href="blog.html">Sea Beach</a>
                                <a href="blog.html">Camping</a>
                                <a href="blog.html">Hiking</a>
                                <a href="blog.html">Fishing</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="error-images" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                            <img src="assets/images/newsletter/404.png" alt="404 Error">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- 404 Error Area end -->
@include('clients.block.footer')