@include('clients.block.header_2')
 <section class="page-banner-two rel z-1">
            <div class="container-fluid">
                <hr class="mt-0">
                <div class="container">
                    <div class="banner-inner pt-15 pb-25">
                        <h2 class="page-title mb-10" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">{{$tourdetail->destination}}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center mb-20" data-aos="fade-right" data-aos-delay="200" data-aos-duration="1500" data-aos-offset="50">
                                <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                <li class="breadcrumb-item active">{{$title}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
<!-- Tour Gallery start -->
<div class="tour-gallery">
    <div class="container-fluid">
        <div class="row gap-10 justify-content-center rel">
            <div class="col-lg-4 col-md-6">
                <div class="gallery-item">
                    <img src="{{ asset('clients/assets/images/image-tour/' . $tourdetail->images[0]) }}" alt="Destination">
                </div>
                <div class="gallery-item ">
                    <img src="{{ asset('clients/assets/images/image-tour/' . $tourdetail->images[1]) }}" alt="Destination">
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="gallery-item gallery-between">
                    <img src="{{ asset('clients/assets/images/image-tour/' . $tourdetail->images[2]) }}" alt="Destination">
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="gallery-item">
                    <img src="{{ asset('clients/assets/images/image-tour/' . $tourdetail->images[3]) }}" alt="Destination">
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('clients/assets/images/image-tour/' . $tourdetail->images[4]) }}" alt="Destination">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tour Gallery End -->


<!-- Tour Header Area start -->
<section class="tour-header-area pt-70 rel z-1">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-6 col-lg-7">
                <div class="tour-header-content mb-15" data-aos="fade-left" data-aos-duration="1500"
                    data-aos-offset="50">
                    <span class="location d-inline-block mb-10"><i class="fal fa-map-marker-alt"></i>{{ $tourdetail->destination }}</span>
                    <div class="section-title pb-5">
                        <h2>{{ $tourdetail->title }}</h2>
                    </div>
                    <div class="ratting">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 text-lg-end" data-aos="fade-right" data-aos-duration="1500"
                data-aos-offset="50">
                <div class="tour-header-social mb-10">
                    <a href="#"><i class="far fa-share-alt"></i>Share tours</a>
                    <a href="#"><i class="fas fa-heart bgc-secondary"></i>Wish list</a>
                </div>
            </div>
        </div>
        <hr class="mt-50 mb-70">
    </div>
</section>
<!-- Tour Header Area end -->


<!-- Tour Details Area start -->
<section class="tour-details-page pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="tour-details-content">
                    <h3>Khám phá Tours</h3>
                    <p>{{ $tourdetail->description }}</p>
                    <div class="row pb-55">
                        <div class="col-md-6">
                            <div class="tour-include-exclude mt-30">
                                <h5>Bao gồm</h5>
                                <ul class="list-style-one check mt-25">
                                    <li><i class="far fa-check"></i> Dịch vụ đón và trả khách</li>
                                    <li><i class="far fa-check"></i> Ăn uống</li>
                                    <li><i class="far fa-check"></i> Bữa tối trên du thuyền</li>
                                    <li><i class="far fa-check"></i> Tham quan các địa điểm nổi tiếng</li>
                                    <li><i class="far fa-check"></i> Đồ uống trên xe miễn phí</li>
                                    <li><i class="far fa-check"></i> Phương tiện di chuyển xịn</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tour-include-exclude mt-30">
                                <h5>Không bao gồm</h5>
                                <ul class="list-style-one mt-25">
                                    <li><i class="far fa-times"></i> Tiền tip cho hướng dẫn viên và tài xế</li>
                                    <li><i class="far fa-times"></i> Chi phí cá nhân ngoài chương trình</li>
                                    <li><i class="far fa-times"></i> Đồ ăn và thức uống ngoài thực đơn</li>
                                    <li><i class="far fa-times"></i> Chi phí nâng cấp dịch vụ</li>
                                    <li><i class="far fa-times"></i> Các dịch vụ phát sinh </li>
                                    <li><i class="far fa-times"></i> Bảo hiểm du lịch</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <h3>Lịch trình</h3>
                <div class="accordion-two mt-25 mb-60" id="faq-accordion-two">
                    @php
                        $day = 1;
                    @endphp
                    @foreach ($tourdetail->timeline as $timeline)
                    <div class="accordion-item">
                        <h5 class="accordion-header">
                            <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo{{ $timeline->timeLineid }}">
                                Ngày {{ $day++ }} - {{ $timeline->title }}
                            </button>
                        </h5>
                        
                        <div id="collapseTwo{{ $timeline->timeLineid }}" class="accordion-collapse collapse"
                            data-bs-parent="#faq-accordion-two">
                            <div class="accordion-body">
                                <p>{{ $timeline->description }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <h3>Clients Reviews</h3>
                <div class="clients-reviews bgc-black mt-30 mb-60">
                    <div class="left">
                        <b>4.8</b>
                        <span>(586 reviews)</span>
                        <div class="ratting">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    <div class="right">
                        <div class="ratting-item">
                            <span class="title">Services</span>
                            <span class="line"><span style="width: 80%;"></span></span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="ratting-item">
                            <span class="title">Guides</span>
                            <span class="line"><span style="width: 70%;"></span></span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="ratting-item">
                            <span class="title">Price</span>
                            <span class="line"><span style="width: 80%;"></span></span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="ratting-item">
                            <span class="title">Safety</span>
                            <span class="line"><span style="width: 80%;"></span></span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="ratting-item">
                            <span class="title">Foods</span>
                            <span class="line"><span style="width: 80%;"></span></span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="ratting-item">
                            <span class="title">Hotels</span>
                            <span class="line"><span style="width: 80%;"></span></span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <h3>Clients Comments</h3>
                <div class="comments mt-30 mb-60">
                    <div class="comment-body" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <div class="author-thumb">
                            <img src="assets/images/blog/comment-author1.jpg" alt="Author">
                        </div>
                        <div class="content">
                            <h6>Lonnie B. Horwitz</h6>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="time">Venice, Rome and Milan – 9 Days 8 Nights</span>
                            <p>Tours and travels play a crucial role in enriching lives by offering unique experiences,
                                cultural exchanges, and the joy of exploration.</p>
                            <a class="read-more" href="#">Reply <i class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="comment-body comment-child" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-offset="50">
                        <div class="author-thumb">
                            <img src="assets/images/blog/comment-author2.jpg" alt="Author">
                        </div>
                        <div class="content">
                            <h6>William G. Edwards</h6>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="time">Venice, Rome and Milan – 9 Days 8 Nights</span>
                            <p>Tours and travels play a crucial role in enriching lives by offering unique experiences,
                                cultural exchanges, and the joy of exploration.</p>
                            <a class="read-more" href="#">Reply <i class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="comment-body" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <div class="author-thumb">
                            <img src="assets/images/blog/comment-author3.jpg" alt="Author">
                        </div>
                        <div class="content">
                            <h6>Jaime B. Wilson</h6>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="time">Venice, Rome and Milan – 9 Days 8 Nights</span>
                            <p>Tours and travels play a crucial role in enriching lives by offering unique experiences,
                                cultural exchanges, and the joy of exploration.</p>
                            <a class="read-more" href="#">Reply <i class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>

                <h3>Add Reviews</h3>
                <form id="comment-form" class="comment-form bgc-lighter z-1 rel mt-30" name="review-form"
                    action="#" method="post" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <div class="comment-review-wrap">
                        <div class="comment-ratting-item">
                            <span class="title">Services</span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="comment-ratting-item">
                            <span class="title">Guides</span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="comment-ratting-item">
                            <span class="title">Price</span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="comment-ratting-item">
                            <span class="title">Safety</span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="comment-ratting-item">
                            <span class="title">Foods</span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="comment-ratting-item">
                            <span class="title">Hotels</span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-30 mb-40">
                    <h5>Leave Feedback</h5>
                    <div class="row gap-20 mt-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full-name">Name</label>
                                <input type="text" id="full-name" name="full-name" class="form-control"
                                    value="" required="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" name="phone" class="form-control"
                                    value="" required="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email-address">Email</label>
                                <input type="email" id="email-address" name="email" class="form-control"
                                    value="" required="">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="message">Comments</label>
                                <textarea name="message" id="message" class="form-control" rows="5" required=""></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-0">
                                <button type="submit" class="theme-btn bgc-secondary style-two">
                                    <span data-hover="Submit reviews">Submit reviews</span>
                                    <i class="fal fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col-lg-4 col-md-8 col-sm-10 rmt-75">
                <div class="blog-sidebar tour-sidebar">

                    <div class="widget widget-booking" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-offset="50">
                        <h5 class="widget-title">Tour Booking</h5>
                        <form action="#">
                            <div class="date mb-25">
                                <b>Ngày bắt đầu</b>
                                <input type="date">
                            </div>
                            <div class="date mb-25">
                                <b>Ngày kết thúc</b>
                                <input type="date">
                            </div>
                            <hr>
                            <div class="time py-5">
                                <b>Thời gian :</b>
                                <p>{{ $tourdetail->time }} </p>
                            </div>
                            <hr class="mb-25">
                            <h6>Vé:</h6>
                            <ul class="tickets clearfix">
                                <li>
                                    Người lớn <span class="price">{{ number_format($tourdetail->priceAdult, 0, ',', '.') }} VND</span>
                                    <input type="number" name="adult_quantity" id="adult_quantity"
                                        class="quantity-input" min="0" value="1">
                                </li>
                                <li>
                                    Trẻ em  <span class="price">{{ number_format($tourdetail->priceChild, 0, ',', '.') }} VND</span>
                                    <input type="number" name="child_quantity" id="child_quantity"
                                        class="quantity-input" min="0" value="0">
                                </li>
                            </ul>
                            <hr class="mb-25">
                            <h6>Tổng tiền: <span class="price">74</span></h6>
                            <button type="submit" class="theme-btn style-two w-100 mt-15 mb-5">
                                <span data-hover="Đặt ngay">Đặt ngay</span>
                                <i class="fal fa-arrow-right"></i>
                            </button>
                            <div class="text-center">
                                <a href="{{ route('contact') }}">Cần giúp đỡ?</a>
                            </div>
                        </form>
                    </div>

                    <div class="widget widget-contact" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-offset="50">
                        <h5 class="widget-title">Need Help?</h5>
                        <ul class="list-style-one">
                            <li><i class="far fa-envelope"></i> <a
                                    href="emilto:helpxample@gmail.com">helpxample@gmail.com</a></li>
                            <li><i class="far fa-phone-volume"></i> <a href="callto:+000(123)45688">+000 (123) 456
                                    88</a></li>
                        </ul>
                    </div>

                    {{-- <div class="widget widget-cta" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <div class="content text-white">
                            <span class="h6">Explore The World</span>
                            <h3>Best Tourist Place</h3>
                            <a href="tour-grid.html" class="theme-btn style-two bgc-secondary">
                                <span data-hover="Explore Now">Explore Now</span>
                                <i class="fal fa-arrow-right"></i>
                            </a>
                        </div>
                        <div class="image">
                            <img src="assets/images/widgets/cta-widget.png" alt="CTA">
                        </div>
                        <div class="cta-shape"><img src="assets/images/widgets/cta-shape3.png" alt="Shape"></div>
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Tour Details Area end -->
@include('clients.block.footer')
