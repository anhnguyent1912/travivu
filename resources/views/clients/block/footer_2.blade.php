<!-- footer area start -->
<footer class="main-footer footer-two bgp-bottom bgc-black rel z-15 pt-100 pb-115"
    style="background-image: url('{{ asset('clients/assets/images/backgrounds/footer-two.png') }}');">
    <div class="widget-area">
        <div class="container">
            <div class="row row-cols-xxl-5 row-cols-xl-4 row-cols-md-3 row-cols-2">
                <div class="col col-small" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <div class="footer-widget footer-text">
                        <div class="footer-logo mb-40">
                            <a href="{{ route('home') }}"><img src="{{ asset('clients/assets/images/logos/logo.png') }}" alt="Tralavivu"></a>
                        </div>
                        <div class="footer-map">
                            <iframe
                                src="https://www.google.com/maps?q=H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam&output=embed"
                                style="border:0; width: 100%;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
                <div class="col col-small" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="footer-widget footer-links ms-sm-5">
                        <div class="footer-title">
                            <h5>Dịch vụ</h5>
                        </div>
                        <ul class="list-style-three">
                            <li><a href="{{ route('contact') }}">Tư vấn tour cá nhân</a></li>
                            <li><a href="{{ route('Tour') }}">Khám phá và đặt tour</a></li>
                            <li><a href="{{ route('Tour') }}">Tour trong ngày</a></li>
                            <li><a href="{{ route('contact') }}">Tư vấn lịch trình</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col col-small" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="footer-widget footer-links ms-md-4">
                        <div class="footer-title">
                            <h5>Công ty</h5>
                        </div>
                        <ul class="list-style-three">
                            <li><a href="{{ route('about') }}">Về Tralavivu</a></li>
                            <li><a href="{{ route('blog') }}">Blog du lịch</a></li>
                            <li><a href="{{ route('contact') }}">Liên hệ với chúng tôi</a></li>
                            <li><a href="{{ route('login') }}">Tài khoản của tôi</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col col-small" data-aos="fade-up" data-aos-delay="150" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="footer-widget footer-links ms-lg-4">
                        <div class="footer-title">
                            <h5>Điểm đến</h5>
                        </div>
                        <ul class="list-style-three">
                            <li><a href="{{ route('destination') }}">Miền Bắc Việt Nam</a></li>
                            <li><a href="{{ route('destination') }}">Miền Trung Việt Nam</a></li>
                            <li><a href="{{ route('destination') }}">Miền Nam Việt Nam</a></li>
                            <li><a href="{{ route('destination') }}">Phú Quốc và biển đảo</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col col-md-6 col-10 col-small" data-aos="fade-up" data-aos-delay="200"
                    data-aos-duration="1500" data-aos-offset="50">
                    <div class="footer-widget footer-contact">
                        <div class="footer-title">
                            <h5>Liên hệ</h5>
                        </div>
                        <ul class="list-style-one">
                                <li><i class="fal fa-map-marked-alt"></i> Hà Nội, Việt Nam
                            </li>
                                <li><i class="fal fa-envelope"></i> <a href="mailto:support@gmail.com">support@gmail.com</a></li>
                                <li><i class="fal fa-phone-volume"></i> <a href="callto:+0001234588">+000 (123) 45 88</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom bg-transparent pt-20 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="copyright-text text-center text-lg-start">
                        <p>Bản quyền 2026 <a href="{{ route('home') }}">Tralavivu</a>, Đã đăng ký bản quyền</p>
                    </div>
                </div>
                <div class="col-lg-7 text-center text-lg-end">
                    <ul class="footer-bottom-nav">
                        <li><a href="{{ route('about') }}">Điều khoản sử dụng</a></li>
                        <li><a href="{{ route('about') }}">Chính sách bảo mật</a></li>
                        <li><a href="{{ route('about') }}">Thông tin pháp lý</a></li>
                        <li><a href="{{ route('contact') }}">Hỗ trợ khách hàng</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->

</div>
<!--End pagewrapper-->


<!-- Jquery -->
<!-- Jquery -->
<script src="{{ asset('clients/assets/js/jquery-3.6.0.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('clients/assets/js/bootstrap.min.js') }}"></script>

<!-- Appear Js -->
<script src="{{ asset('clients/assets/js/appear.min.js') }}"></script>

<!-- Slick -->
<script src="{{ asset('clients/assets/js/slick.min.js') }}"></script>

<!-- Magnific Popup -->
<script src="{{ asset('clients/assets/js/jquery.magnific-popup.min.js') }}"></script>

<!-- Nice Select -->
<script src="{{ asset('clients/assets/js/jquery.nice-select.min.js') }}"></script>

<!-- Image Loader -->
<script src="{{ asset('clients/assets/js/imagesloaded.pkgd.min.js') }}"></script>

<!-- Jquery UI -->
<script src="{{ asset('clients/assets/js/jquery-ui.min.js') }}"></script>

<!-- Isotope -->
<script src="{{ asset('clients/assets/js/isotope.pkgd.min.js') }}"></script>

<!-- AOS Animation -->
<script src="{{ asset('clients/assets/js/aos.js') }}"></script>

<!-- Custom script -->
<script src="{{ asset('clients/assets/js/script.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('clients/assets/js/login.js') }}"></script>
<script src="{{ asset('clients/assets/js/jquery.datetimepicker.full.min.js') }}"></script>
</body>

</html>