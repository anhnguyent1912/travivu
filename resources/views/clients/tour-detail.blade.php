@include('clients.block.header_2')
<section class="page-banner-two tour-detail-banner rel z-1">
    <div class="container-fluid">
        <div class="container">
            <div class="banner-inner pt-15 pb-25">
                <h2 class="page-title mb-10" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                    {{ $tourdetail->destination }}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-20" data-aos="fade-right" data-aos-delay="200"
                        data-aos-duration="1500" data-aos-offset="50">
                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
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
                    <img src="{{ asset('clients/assets/images/image-tour/' . $tourdetail->images[0]) }}"
                        alt="Destination">
                </div>
                <div class="gallery-item ">
                    <img src="{{ asset('clients/assets/images/image-tour/' . $tourdetail->images[1]) }}"
                        alt="Destination">
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="gallery-item gallery-between">
                    <img src="{{ asset('clients/assets/images/image-tour/' . $tourdetail->images[2]) }}"
                        alt="Destination">
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="gallery-item">
                    <img src="{{ asset('clients/assets/images/image-tour/' . $tourdetail->images[3]) }}"
                        alt="Destination">
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('clients/assets/images/image-tour/' . $tourdetail->images[4]) }}"
                        alt="Destination">
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
                    <span class="location d-inline-block mb-10"><i
                            class="fal fa-map-marker-alt"></i>{{ $tourdetail->destination }}</span>
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

                {{-- <h3>Đánh giá trải nghiệm</h3>
                <div class="clients-reviews bgc-black mt-30 mb-60">
                    <div class="left">
                        <b>4.8</b>
                        <span>(586 đánh giá)</span>
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
                            <span class="title">Dịch vụ</span>
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
                            <span class="title">Giá cả</span>
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
                            <span class="title">An toàn</span>
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
                            <span class="title">Ẩm thực</span>
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
                            <span class="title">Khách sạn</span>
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

                <h3>Bình luận của khách hàng</h3>
                <div class="comments mt-30 mb-60">
                    <div class="comment-body" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <div class="author-thumb">
                            <img src="assets/images/blog/comment-author1.jpg" alt="Author">
                        </div>
                        <div class="content">
                            <h6>Dao Thi C</h6>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="time">Tour: {{ $tourdetail->title }}</span>
                            <p>Các chuyến du lịch mang đến những trải nghiệm độc đáo, cơ hội giao lưu văn hóa và niềm
                                vui khám phá.</p>
                            <a class="read-more" href="#">Trả lời <i class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="comment-body comment-child" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-offset="50">
                        <div class="author-thumb">
                            <img src="assets/images/blog/comment-author2.jpg" alt="Author">
                        </div>
                        <div class="content">
                            <h6>Tran Van H</h6>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="time">Tour: {{ $tourdetail->title }}</span>
                            <p>Các chuyến du lịch mang đến những trải nghiệm độc đáo, cơ hội giao lưu văn hóa và niềm
                                vui khám phá.</p>
                            <a class="read-more" href="#">Trả lời <i class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="comment-body" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <div class="author-thumb">
                            <img src="assets/images/blog/comment-author3.jpg" alt="Author">
                        </div>
                        <div class="content">
                            <h6>Nguyen Van B</h6>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="time">Tour: {{ $tourdetail->title }}</span>
                            <p>Các chuyến du lịch mang đến những trải nghiệm độc đáo, cơ hội giao lưu văn hóa và niềm
                                vui khám phá.</p>
                            <a class="read-more" href="#">Trả lời <i class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>

                <h3>Thêm đánh giá</h3>
                <form id="comment-form" class="comment-form bgc-lighter z-1 rel mt-30" name="review-form"
                    action="#" method="post" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <div class="comment-review-wrap">
                        <div class="comment-ratting-item">
                            <span class="title">Dịch vụ</span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="comment-ratting-item">
                            <span class="title">Giá cả</span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="comment-ratting-item">
                            <span class="title">An toàn</span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="comment-ratting-item">
                            <span class="title">Ẩm thực</span>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <div class="comment-ratting-item">
                            <span class="title">Khách sạn</span>
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
                    <h5>Để lại nhận xét</h5>
                    <div class="row gap-20 mt-20">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full-name">Họ và tên</label>
                                <input type="text" id="full-name" name="full-name" class="form-control"
                                    value="" required="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Số điện thoại</label>
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
                                <label for="message">Nội dung nhận xét</label>
                                <textarea name="message" id="message" class="form-control" rows="5" required=""></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-0">
                                <button type="submit" class="theme-btn bgc-secondary style-two">
                                    <span data-hover="Gửi đánh giá">Gửi đánh giá</span>
                                    <i class="fal fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form> --}}

            </div>
            <div class="col-lg-4 col-md-8 col-sm-10 rmt-75">
                <div class="blog-sidebar tour-sidebar">

                    <div class="widget widget-booking">
                        <h5 class="widget-title">Thông tin tour</h5>
                        <form id="booking-form"
                            action="{{ route('booking.store', ['tourid' => $tourdetail->tourid]) }}" method="POST"
                            novalidate>
                            @csrf

                            {{-- Thông báo lưu đơn thành công --}}
                            @if (session('booking_success'))
                                <div class="alert alert-success" role="status">
                                    {{ session('booking_success') }}
                                </div>
                            @endif

                            {{--tour đóng, hết hạn hoặc không đủ chỗ --}}
                            @error('booking')
                                <p class="text-danger" role="alert">{{ $message }}</p>
                            @enderror

                            <div class="date mb-25">
                                <b>Ngày bắt đầu</b>
                                <input type="text"
                                    value="{{ $tourdetail->startDate ? date('d-m-Y', strtotime($tourdetail->startDate)) : 'Chưa cập nhật' }}"
                                    disabled>
                            </div>

                            <div class="date mb-25">
                                <b>Ngày kết thúc</b>
                                <input type="text"
                                    value="{{ $tourdetail->endDate ? date('d-m-Y', strtotime($tourdetail->endDate)) : 'Chưa cập nhật' }}"
                                    disabled>
                            </div>

                            <p>Thời gian: {{ $tourdetail->time }}</p>

                            <hr>

                            <div class="form-group">
                                <label for="adult_quantity">
                                    Người lớn —
                                    {{ number_format($tourdetail->priceAdult, 0, ',', '.') }} VND/người
                                </label>

                                <input type="number" id="adult_quantity" name="adult_quantity" class="form-control"
                                    min="1" max="100" step="1"
                                    value="{{ old('adult_quantity', 1) }}" required>

                                @error('adult_quantity')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="child_quantity">
                                    Trẻ em —
                                    {{ number_format($tourdetail->priceChild, 0, ',', '.') }} VND/người
                                </label>

                                <input type="number" id="child_quantity" name="child_quantity" class="form-control"
                                    min="0" max="100" step="1"
                                    value="{{ old('child_quantity', 0) }}" required>

                                @error('child_quantity')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- <hr>
                            <h6>Thông tin liên hệ</h6>
                            <div class="form-group">
                                <label for="booking-contact-name">Họ và tên</label>

                                <input type="text" id="booking-contact-name" name="contactName"
                                    class="form-control" value="{{ old('contactName', auth()->user()?->fullname) }}"
                                    maxlength="100" autocomplete="name" required>

                                @error('contactName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="booking-contact-email">Email</label>

                                <input type="email" id="booking-contact-email" name="contactEmail"
                                    class="form-control" value="{{ old('contactEmail', auth()->user()?->email) }}"
                                    maxlength="255" autocomplete="email" required>

                                @error('contactEmail')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="booking-contact-phone">Số điện thoại</label>

                                <input type="tel" id="booking-contact-phone" name="contactPhone"
                                    class="form-control"
                                    value="{{ old('contactPhone', auth()->user()?->phoneNumber) }}" maxlength="10"
                                    inputmode="numeric" autocomplete="tel" required>

                                @error('contactPhone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div> --}}
                            {{-- <div class="form-group">
                                <label for="booking-special-requests">
                                    Yêu cầu thêm (không bắt buộc)
                                </label>

                                <textarea id="booking-special-requests" name="specialRequests" class="form-control" rows="3" maxlength="255">{{ old('specialRequests') }}</textarea>

                                @error('specialRequests')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div> --}}

                            @auth
                                <button type="submit" class="theme-btn style-two w-100 mt-15 mb-5">
                                    <span data-hover="Gửi yêu cầu đặt tour">
                                        Gửi yêu cầu đặt tour
                                    </span>
                                    <i class="fal fa-arrow-right" aria-hidden="true"></i>
                                </button>
                            @else
                                <p>Vui lòng đăng nhập trước khi đặt tour.</p>

                                <a href="{{ route('login') }}" class="theme-btn style-two w-100 mt-15 mb-5">
                                    <span data-hover="Đăng nhập để đặt tour">
                                        Đăng nhập để đặt tour
                                    </span>
                                </a>
                            @endauth

                            <div class="text-center">
                                <a href="{{ route('contact') }}">Cần giúp đỡ?</a>
                            </div>
                        </form>
                    </div>

                    <div class="widget widget-contact">
                        <h5 class="widget-title">Cần hỗ trợ thêm liên hệ ngay</h5>
                        <ul class="list-style-one">
                            <li><i class="far fa-envelope"></i> <a
                                    href="emilto:helpxample@gmail.com">lienhe@gmail.com</a></li>
                            <li><i class="far fa-phone-volume"></i> <a href="callto:+000(123)45688">+84 123 456 789</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Tour Details Area end -->
@include('clients.block.footer')
