@include('clients.block.header')
@include('clients.block.banner')
<!--Form Back Drop-->
{{-- <div class="form-back-drop"></div>

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
<!--End Hidden Sidebar --> --}}

<!-- Destinations Area start -->
<section class="destinations-area bgc-black pt-100 pb-70 rel z-1">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title text-white text-center counter-text-wrap mb-70" data-aos="fade-up"
                    data-aos-duration="1500" data-aos-offset="50">
                    <h2>Khám phá kho báu việt nam cùng Travivu</h2>
                    <p>Website với <span class="count-text plus" data-speed="3000" data-stop="1240">0</span> địa điểm
                        phổ biến nhất mà bạn sẽ nhớ</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xxl-3 col-xl-4 col-md-6">
                <div class="destination-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <div class="image">
                        <div class="ratting"><i class="fas fa-star"></i> 4.8</div>
                        <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                        <img src="{{asset('clients/assets/images/destinations/visiting-place1.jpg')}}" alt="Destination">
                    </div>
                    <div class="content">
                        <span class="location"><i class="fal fa-map-marker-alt"></i> Tours, France</span>
                        <h5><a href="destination-details.html">Brown Concrete Building Basilica St Martin</a></h5>
                        <span class="time">3 days 2 nights - Couple</span>
                    </div>
                    <div class="destination-footer">
                        <span class="price"><span>$58.00</span>/per person</span>
                        <a href="#" class="read-more">Đặt ngay <i class="fal fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            {{-- <div class="col-xxl-3 col-xl-4 col-md-6">
                <div class="destination-item" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="image">
                        <div class="ratting"><i class="fas fa-star"></i> 4.8</div>
                        <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                        <img src="assets/images/destinations/visiting-place2.jpg" alt="Destination">
                    </div>
                    <div class="content">
                        <span class="location"><i class="fal fa-map-marker-alt"></i> Wildest, Italy</span>
                        <h5><a href="destination-details.html">Blue lake water view taken travel with daytime</a></h5>
                        <span class="time">3 days 2 nights - Couple</span>
                    </div>
                    <div class="destination-footer">
                        <span class="price"><span>$63.00</span>/per person</span>
                        <a href="#" class="read-more">Book Now <i class="fal fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-md-6">
                <div class="destination-item" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="image">
                        <div class="ratting"><i class="fas fa-star"></i> 4.8</div>
                        <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                        <img src="assets/images/destinations/visiting-place3.jpg" alt="Destination">
                    </div>
                    <div class="content">
                        <span class="location"><i class="fal fa-map-marker-alt"></i> Rome, Italy</span>
                        <h5><a href="destination-details.html">Woman standing near Colosseum, Rome</a></h5>
                        <span class="time">3 days 2 nights - Couple</span>
                    </div>
                    <div class="destination-footer">
                        <span class="price"><span>$42</span>/per person</span>
                        <a href="#" class="read-more">Book Now <i class="fal fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-md-6">
                <div class="destination-item" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="image">
                        <div class="ratting"><i class="fas fa-star"></i> 4.8</div>
                        <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                        <img src="assets/images/destinations/visiting-place4.jpg" alt="Destination">
                    </div>
                    <div class="content">
                        <span class="location"><i class="fal fa-map-marker-alt"></i> Rome, Italy</span>
                        <h5><a href="destination-details.html">Woman standing near Colosseum, Rome</a></h5>
                        <span class="time">3 days 2 nights - Couple</span>
                    </div>
                    <div class="destination-footer">
                        <span class="price"><span>$52.00</span>/per person</span>
                        <a href="#" class="read-more">Book Now <i class="fal fa-angle-right"></i></a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>
<!-- Destinations Area end -->


<!-- About Us Area start -->
<section class="about-us-area py-100 rpb-90 rel z-1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-5 col-lg-6">
                <div class="about-us-content rmb-55" data-aos="fade-left" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="section-title mb-25">
                        <h2>Du lịch với sự tự tin Lý do hàng đầu để chọn công ty chúng tôi</h2>
                    </div>
                    <p>Chúng tôi sẽ nỗ lực hết mình để biến giấc mơ du lịch của bạn thành hiện thực những viên ngọc ẩn
                        và những điểm tham quan không thể bỏ qua
                    </p>
                    <div class="divider counter-text-wrap mt-45 mb-55"><span>Chúng tôi có <span><span
                                    class="count-text plus" data-speed="3000" data-stop="5">0</span> Năm</span>
                            kinh nghiệm</span></div>
                    <div class="row">
                        <div class="col-6">
                            <div class="counter-item counter-text-wrap">
                                <span class="count-text k-plus" data-speed="3000" data-stop="2">0</span>
                                <span class="counter-title">Điểm đến phổ biến</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="counter-item counter-text-wrap">
                                <span class="count-text m-plus" data-speed="3000" data-stop="3">0</span>
                                <span class="counter-title">Khách hàng hài lòng</span>
                            </div>
                        </div>
                    </div>
                    <a href="destination1.html" class="theme-btn mt-10 style-two">
                        <span data-hover="Khám phá điểm đến">Khám phá Điểm đến</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                <div class="about-us-image">
                    <div class="shape"><img src="{{asset('clients/assets/images/about/shape1.png')}}" alt="Shape"></div>
                    <div class="shape"><img src="{{asset('clients/assets/images/about/shape2.png')}}" alt="Shape"></div>
                    <div class="shape"><img src="{{asset('clients/assets/images/about/shape3.png')}}" alt="Shape"></div>
                    <div class="shape"><img src="{{asset('clients/assets/images/about/shape4.png')}}" alt="Shape"></div>
                    <div class="shape"><img src="{{asset('clients/assets/images/about/shape5.png')}}" alt="Shape"></div>
                    <div class="shape"><img src="{{asset('clients/assets/images/about/shape6.png')}}" alt="Shape"></div>
                    <div class="shape"><img src="{{asset('clients/assets/images/about/shape7.png')}}" alt="Shape"></div>
                    <img src="{{asset('clients/assets/images/about/about.png')}}" alt="About">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Us Area end -->


<!-- Popular Destinations Area start -->
<section class="popular-destinations-area rel z-1">
    <div class="container-fluid">
        <div class="popular-destinations-wrap br-20 bgc-lighter pt-100 pb-70">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-title text-center counter-text-wrap mb-70" data-aos="fade-up"
                        data-aos-duration="1500" data-aos-offset="50">
                        <h2>Khám phá các điểm đến phổ biến</h2>
                        <p>Website với <span class="count-text plus" data-speed="3000" data-stop="1240">0</span> trải
                            nghiệm phổ biến nhất</p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-3 col-md-6">
                        <div class="destination-item style-two" data-aos="flip-up" data-aos-duration="1500"
                            data-aos-offset="50">
                            <div class="image">
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <img src="{{asset('clients/assets/images/destinations/destination1.jpg')}}" alt="Destination">
                            </div>
                            <div class="content">
                                <h6><a href="destination-details.html">Thailand beach</a></h6>
                                <span class="time">5352+ tours & 856+ Activity</span>
                                <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="destination-item style-two" data-aos="flip-up" data-aos-delay="100"
                            data-aos-duration="1500" data-aos-offset="50">
                            <div class="image">
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <img src="{{asset('clients/assets/images/destinations/destination2.jpg')}}" alt="Destination">
                            </div>
                            <div class="content">
                                <h6><a href="destination-details.html">Parga, Greece</a></h6>
                                <span class="time">5352+ tours & 856+ Activity</span>
                                <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="destination-item style-two" data-aos="flip-up" data-aos-delay="200"
                            data-aos-duration="1500" data-aos-offset="50">
                            <div class="image">
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <img src="{{asset('clients/assets/images/destinations/destination3.jpg')}}" alt="Destination">
                            </div>
                            <div class="content">
                                <h6><a href="destination-details.html">Castellammare del Golfo, Italy</a></h6>
                                <span class="time">5352+ tours & 856+ Activity</span>
                                <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="destination-item style-two" data-aos="flip-up" data-aos-duration="1500"
                            data-aos-offset="50">
                            <div class="image">
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <img src="{{asset('clients/assets/images/destinations/destination4.jpg')}}" alt="Destination">
                            </div>
                            <div class="content">
                                <h6><a href="destination-details.html">Reserve of Canada, Canada</a></h6>
                                <span class="time">5352+ tours & 856+ Activity</span>
                                <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="destination-item style-two" data-aos="flip-up" data-aos-delay="100"
                            data-aos-duration="1500" data-aos-offset="50">
                            <div class="image">
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <img src="{{asset('clients/assets/images/destinations/destination5.jpg')}}" alt="Destination">
                            </div>
                            <div class="content">
                                <h6><a href="destination-details.html">Dubai united states</a></h6>
                                <span class="time">5352+ tours & 856+ Activity</span>
                                <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="destination-item style-two" data-aos="flip-up" data-aos-delay="200"
                            data-aos-duration="1500" data-aos-offset="50">
                            <div class="image">
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <img src="{{asset('clients/assets/images/destinations/destination6.jpg')}}" alt="Destination">
                            </div>
                            <div class="content">
                                <h6><a href="destination-details.html">Milos, Greece</a></h6>
                                <span class="time">5352+ tours & 856+ Activity</span>
                                <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Popular Destinations Area end -->


<!-- Features Area start -->
<section class="features-area pt-100 pb-45 rel z-1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6">
                <div class="features-content-part mb-55" data-aos="fade-left" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="section-title mb-60">
                        <h2>Trải nghiệm du lịch tuyệt đỉnh mang đến sự khác biệt cho công ty chúng tôi</h2>
                    </div>
                    <div class="features-customer-box">
                        <div class="image">
                            <img src="{{asset('clients/assets/images/features/features-box.jpg')}}" alt="Features">
                        </div>
                        <div class="content">
                            <div class="feature-authors mb-15">
                                <img src="{{asset('clients/assets/images/features/feature-author1.jpg')}}" alt="Author">
                                <img src="{{asset('clients/assets/images/features/feature-author2.jpg')}}" alt="Author">
                                <img src="{{asset('clients/assets/images/features/feature-author3.jpg')}}" alt="Author">
                                <span>4k+</span>
                            </div>
                            <h6>850K+ Khách hàng hài lòng</h6>
                            <div class="divider style-two counter-text-wrap my-25"><span><span class="count-text plus"
                                        data-speed="3000" data-stop="5">0</span> Năm</span></div>
                            <p>Chúng tôi tự hào cung cấp các hành trình được cá nhân hóa</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                <div class="row pb-25">
                    <div class="col-md-6">
                        <div class="feature-item">
                            <div class="icon"><i class="flaticon-tent"></i></div>
                            <div class="content">
                                <h5><a href="{{ route('Tour') }}">Chinh Phục Cảnh Quan Việt Nam</a></h5>
                                <p>Khám phá những cảnh đẹp hùng vĩ và tuyệt vời của đất nước Việt Nam.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="icon"><i class="flaticon-tent"></i></div>
                            <div class="content">
                                <h5><a href="{{ route('Tour') }}">Trải Nghiệm Đặc Sắc Việt Nam</a></h5>
                                <p>Trải nghiệm những hoạt động và lễ hội đặc trưng của văn hóa Việt.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="feature-item mt-20">
                            <div class="icon"><i class="flaticon-tent"></i></div>
                            <div class="content">
                                <h5><a href="{{ route('Tour') }}">Khám Phá Di Sản Việt Nam</a></h5>
                                <p>Khám phá các di sản thế giới và những kỳ quan thiên nhiên nổi tiếng.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="icon"><i class="flaticon-tent"></i></div>
                            <div class="content">
                                <h5><a href="{{ route('Tour') }}">Vẻ Đẹp Thiên Nhiên Việt</a></h5>
                                <p>Chinh phục vẻ đẹp tự nhiên hoang sơ và kỳ vĩ của Việt Nam.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Features Area end -->

<!-- Testimonials Area start -->
{{-- <section class="testimonials-area rel z-1">
    <div class="container">
        <div class="testimonials-wrap bgc-lighter">
            <div class="row">
                <div class="col-lg-5 rel" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                    <div class="testimonial-left-image rmb-55"
                        style="background-image: url({{asset('clients/assets/images/testimonials/testimonial-left.jpg')}});"></div>
                </div>
                <div class="col-lg-7">
                    <div class="testimonial-right-content" data-aos="fade-left" data-aos-duration="1500"
                        data-aos-offset="50">
                        <div class="section-title mb-55">
                            <h2><span>5280</span> Global Clients Say About Us Services</h2>
                        </div>
                        <div class="testimonials-active">
                            <div class="testimonial-item">
                                <div class="testi-header">
                                    <div class="quote"><i class="flaticon-double-quotes"></i></div>
                                    <h4>Quality Services</h4>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                                <div class="text">"Our trip was absolutely a perfect, thanks this travel agency! They
                                    took care of every detail, from to accommodations, and even suggested incredible
                                    experiences"</div>
                                <div class="author">
                                    <div class="image"><img src="{{asset('clients/assets/images/testimonials/author.jpg')}}"
                                            alt="Author"></div>
                                    <div class="content">
                                        <h5>Randall V. Vasquez</h5>
                                        <span>Graphics Designer</span>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-item">
                                <div class="testi-header">
                                    <div class="quote"><i class="flaticon-double-quotes"></i></div>
                                    <h4>Quality Services</h4>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                                <div class="text">"Our trip was absolutely a perfect, thanks this travel agency! They
                                    took care of every detail, from to accommodations, and even suggested incredible
                                    experiences"</div>
                                <div class="author">
                                    <div class="image"><img src="{{asset('clients/assets/images/testimonials/author.jpg')}}"
                                            alt="Author"></div>
                                    <div class="content">
                                        <h5>Randall V. Vasquez</h5>
                                        <span>Graphics Designer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- Testimonials Area end -->


<!-- CTA Area start -->
<section class="cta-area pt-100 rel z-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-duration="1500" data-aos-offset="50">
                <div class="cta-item" style="background-image: url({{asset('clients/assets/images/cta/cta1.jpg')}});">
                    <span class="category">Khám Phá Vẻ Đẹp Văn Hóa Việt</span>
                    <h2>Tìm hiểu những giá trị văn hóa độc đáo của các vùng miền Việt Nam.</h2>
                    <a href="{{ route('Tour') }}" class="theme-btn style-two bgc-secondary">
                        <span data-hover="Khám phá">Khám phá</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-delay="50" data-aos-duration="1500"
                data-aos-offset="50">
                <div class="cta-item" style="background-image: url({{asset('clients/assets/images/cta/cta2.jpg')}});">
                    <span class="category">Bãi biển</span>
                    <h2>Bãi trong xanh dạt dào ở Việt Nam</h2>
                    <a href="{{ route('Tour') }}" class="theme-btn style-two">
                        <span data-hover="Khám phá">Khám phá</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-delay="100" data-aos-duration="1500"
                data-aos-offset="50">
                <div class="cta-item" style="background-image: url({{asset('clients/assets/images/cta/cta3.jpg')}});">
                    <span class="category">Thác nước</span>
                    <h2>Thác nước lớn nhất Việt NamKhám phá</h2>
                    <a href="{{ route('Tour') }}" class="theme-btn style-two bgc-secondary">
                        <span data-hover="Khám phá">Khám phá</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CTA Area end -->


<!-- Blog Area start -->
{{-- <section class="blog-area py-70 rel z-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title text-center counter-text-wrap mb-70" data-aos="fade-up"
                    data-aos-duration="1500" data-aos-offset="50">
                    <h2>Read Latest News & Blog</h2>
                    <p>One site <span class="count-text plus bgc-primary" data-speed="3000"
                            data-stop="1240">0</span> most popular experience you’ll remember</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-4 col-md-6">
                <div class="blog-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <div class="content">
                        <a href="blog.html" class="category">Travel</a>
                        <h5><a href="blog-details.html">Ultimate Guide to Planning Your Dream Vacation with Ravelo
                                Travel Agency</a></h5>
                        <ul class="blog-meta">
                            <li><i class="far fa-calendar-alt"></i> <a href="#">25 February 2024</a></li>
                            <li><i class="far fa-comments"></i> <a href="#">Comments (5)</a></li>
                        </ul>
                    </div>
                    <div class="image">
                        <img src="{{asset('clients/assets/images/blog/blog1.jpg')}}" alt="Blog">
                    </div>
                    <a href="blog-details.html" class="theme-btn">
                        <span data-hover="Book Now">Read More</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="blog-item" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="content">
                        <a href="blog.html" class="category">Travel</a>
                        <h5><a href="blog-details.html">Unforgettable Adventures Travel Agency Bucket List
                                Experiences</a></h5>
                        <ul class="blog-meta">
                            <li><i class="far fa-calendar-alt"></i> <a href="#">25 February 2024</a></li>
                            <li><i class="far fa-comments"></i> <a href="#">Comments (5)</a></li>
                        </ul>
                    </div>
                    <div class="image">
                        <img src="{{asset('clients/assets/images/blog/blog2.jpg')}}" alt="Blog">
                    </div>
                    <a href="blog-details.html" class="theme-btn">
                        <span data-hover="Book Now">Read More</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="blog-item" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="content">
                        <a href="blog.html" class="category">Travel</a>
                        <h5><a href="blog-details.html">Exploring Culture and way Cuisine Travel Agency's they Best
                                Foodie Destinations</a></h5>
                        <ul class="blog-meta">
                            <li><i class="far fa-calendar-alt"></i> <a href="#">25 February 2024</a></li>
                            <li><i class="far fa-comments"></i> <a href="#">Comments (5)</a></li>
                        </ul>
                    </div>
                    <div class="image">
                        <img src="{{asset('clients/assets/images/blog/blog3.jpg')}}" alt="Blog">
                    </div>
                    <a href="blog-details.html" class="theme-btn">
                        <span data-hover="Book Now">Read More</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<!-- Blog Area end -->

@include('clients.block.footer')
