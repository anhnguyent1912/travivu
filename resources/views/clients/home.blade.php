@include('clients.block.header')
@include('clients.block.banner')
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
            @foreach ($Tour as $tour)
            <div class="col-xxl-3 col-xl-4 col-md-6">
                <div class="destination-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <div class="image">
                        <div class="ratting"><i class="fas fa-star"></i> 4.8</div>
                        <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                        <img src="{{ asset('clients/assets/images/image-tour/' . $tour->images->first()) }}" alt="Destination">
                    </div>
                    <div class="content">
                        <span class="location"><i class="fal fa-map-marker-alt"></i>{{ $tour->destination }}</span>
                        <h5><a href="{{ route('tour-detail', ['id' => $tour->tourid]) }}">{{ $tour->title }}</a></h5>
                        <span class="time">{{ $tour->time }} </span>
                    </div>
                    <div class="destination-footer">
                        <span class="price"><span>{{ number_format($tour->priceAdult, 0, ',', '.') }}</span>VND / người</span>
                        <a href="{{ route('tour-detail',['id' => $tour->tourid]) }}" class="read-more">Đặt ngay <i class="fal fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Destinations Area end -->
<!-- Popular Destinations Area start -->
<section class="popular-destinations-area rel z-1">
    <div class="container-fluid">
        <div class="popular-destinations-wrap br-20 bgc-lighter pt-100 pb-70">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-title text-center counter-text-wrap mb-70">
                        <h2>Khám phá các điểm đến phổ biến</h2>
                        <p>Website với <span class="count-text plus" data-speed="3000" data-stop="1240">0</span> trải
                            nghiệm phổ biến nhất</p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-3 col-md-6">
                        <div class="destination-item style-two">
                            <div class="image">
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <img src="{{asset('clients/assets/images/destinations/destination1.jpg')}}" alt="Destination">
                            </div>
                            <div class="content">
                                <h6><a href="destination-details.html">beach</a></h6>
                                <span class="time">abcxyz</span>
                                <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="destination-item style-two">
                            <div class="image">
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <img src="{{asset('clients/assets/images/destinations/destination2.jpg')}}" alt="Destination">
                            </div>
                            <div class="content">
                                <h6><a href="destination-details.html">abc</a></h6>
                                <span class="time">defghi</span>
                                <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="destination-item style-two">
                            <div class="image">
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <img src="{{asset('clients/assets/images/destinations/destination3.jpg')}}" alt="Destination">
                            </div>
                            <div class="content">
                                <h6><a href="destination-details.html">def</a></h6>
                                <span class="time">jklmno</span>
                                <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="destination-item style-two">
                            <div class="image">
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <img src="{{asset('clients/assets/images/destinations/destination4.jpg')}}" alt="Destination">
                            </div>
                            <div class="content">
                                <h6><a href="destination-details.html">ghi</a></h6>
                                <span class="time">pqrst</span>
                                <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="destination-item style-two">
                            <div class="image">
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <img src="{{asset('clients/assets/images/destinations/destination5.jpg')}}" alt="Destination">
                            </div>
                            <div class="content">
                                <h6><a href="destination-details.html">jkl</a></h6>
                                <span class="time">uvwxy</span>
                                <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="destination-item style-two">
                            <div class="image">
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <img src="{{asset('clients/assets/images/destinations/destination6.jpg')}}" alt="Destination">
                            </div>
                            <div class="content">
                                <h6><a href="destination-details.html">mno</a></h6>
                                <span class="time">zabcde</span>
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
                            <h6>1K+ Khách hàng hài lòng</h6>
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

@include('clients.block.footer')
