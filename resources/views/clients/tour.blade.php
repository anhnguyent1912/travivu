@include('clients.block.header_2')
@include('clients.block.banner_2')

<!-- Tour Grid Area start -->
<section class="tour-grid-page py-100 rel z-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-10 rmb-75">
                <div class="shop-sidebar">
                    <div class="div_filter_clear">
                        <button class="clear_filter" name="btn_clear">
                            <a href="{{ route('Tour') }}">Clear</a>
                        </button>
                    </div>
                    <div class="widget widget-filter" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500"
                        data-aos-offset="50">
                        <h6 class="widget-title">Lọc theo giá</h6>
                        <div class="price-filter-wrap">
                            <div class="price-slider-range"></div>
                            <div class="price">
                                <span>Giá </span>
                                <input type="text" id="price" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="widget widget-activity" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-offset="50">
                        <h6 class="widget-title">Điểm đến</h6>
                        <ul class="radio-filter">
                            <li>
                                <input class="form-check-input" type="radio" checked name="ByActivities"
                                    id="activity1">
                                <label for="activity1">Miền Bắc <span>18</span></label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="ByActivities" id="activity2">
                                <label for="activity2">Miền Trung <span>29</span></label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="ByActivities" id="activity3">
                                <label for="activity3">Miền Nam <span>23</span></label>
                            </li>
                        </ul>
                    </div>

                    <div class="widget widget-reviews" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <h6 class="widget-title">Đánh giá</h6>
                        <ul class="radio-filter">
                            <li>
                                <input class="form-check-input" type="radio" checked name="ByReviews" id="review1">
                                <label for="review1">
                                    <span class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </span>
                                </label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="ByReviews" id="review2">
                                <label for="review2">
                                    <span class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt white"></i>
                                    </span>
                                </label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="ByReviews" id="review3">
                                <label for="review3">
                                    <span class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star white"></i>
                                        <i class="fas fa-star-half-alt white"></i>
                                    </span>
                                </label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="ByReviews" id="review4">
                                <label for="review4">
                                    <span class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star white"></i>
                                        <i class="fas fa-star white"></i>
                                        <i class="fas fa-star-half-alt white"></i>
                                    </span>
                                </label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="ByReviews" id="review5">
                                <label for="review5">
                                    <span class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star white"></i>
                                        <i class="fas fa-star white"></i>
                                        <i class="fas fa-star white"></i>
                                        <i class="fas fa-star-half-alt white"></i>
                                    </span>
                                </label>
                            </li>
                        </ul>
                    </div>

                    <div class="widget widget-languages" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-offset="50">
                        <h6 class="widget-title">Thời gian</h6>
                        <ul class="radio-filter">
                            <li>
                                <input class="form-check-input" type="radio" checked name="ByLanguages"
                                    id="language1">
                                <label for="language1">3 ngày 2 đêm</label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="ByLanguages" id="language2">
                                <label for="language2">4 ngày 3 đêm</label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="ByLanguages" id="language3">
                                <label for="language3">5 ngày 4 đêm</label>
                            </li>
                        </ul>
                    </div>

                    {{-- <div class="widget widget-duration" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-offset="50">
                        <h6 class="widget-title">Duration</h6>
                        <ul class="radio-filter">
                            <li>
                                <input class="form-check-input" type="radio" checked name="Duration"
                                    id="duration1">
                                <label for="duration1">0 - 2 hours</label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="Duration" id="duration2">
                                <label for="duration2">2 - 4 hours</label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="Duration" id="duration3">
                                <label for="duration3">4 - 8 hours</label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="Duration" id="duration4">
                                <label for="duration4">Fulda (+8 hours)</label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="Duration" id="duration5">
                                <label for="duration5">Multi days</label>
                            </li>
                        </ul>
                    </div> --}}

                    {{-- <div class="widget widget-tour" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-offset="50">
                        <h6 class="widget-title">Phổ biến</h6>
                        <div class="destination-item tour-grid style-three bgc-lighter">
                            <div class="image">
                                <span class="badge">10% Off</span>
                                <img src="assets/images/widgets/tour1.jpg" alt="Tour">
                            </div>
                            <div class="content">
                                <div class="destination-header">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i> Bali,
                                        Indonesia</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <span>(4.8)</span>
                                    </div>
                                </div>
                                <h6><a href="tour-details.html">Relinking Beach, Bali, Indonesia</a></h6>
                            </div>
                        </div>
                        <div class="destination-item tour-grid style-three bgc-lighter">
                            <div class="image">
                                <img src="assets/images/widgets/tour1.jpg" alt="Tour">
                            </div>
                            <div class="content">
                                <div class="destination-header">
                                    <span class="location"><i class="fal fa-map-marker-alt"></i> Bali,
                                        Indonesia</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <span>(4.8)</span>
                                    </div>
                                </div>
                                <h6><a href="tour-details.html">Relinking Beach, Bali, Indonesia</a></h6>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="widget widget-cta mt-30" data-aos="fade-up" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="content text-white">
                        <span class="h6">Khám phá Việt Nam</span>
                        <h3>Địa điểm du lịch tôt nhất</h3>
                        <a href="{{ route('Tour') }}" class="theme-btn style-two bgc-secondary">
                            <span data-hover="Đặt ngay">Đặt ngay</span>
                            <i class="fal fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="image">
                        <img src="{{ asset('clients/assets/images/widgets/cta-widget.png') }}" alt="CTA">
                    </div>
                    <div class="cta-shape"><img src="{{ asset('clients/assets/images/widgets/cta-shape2.png') }}" alt="Shape"></div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop-shorter rel z-3 mb-20">
                    <div class="sort-text mb-15 me-4 me-xl-auto">
                        Tours tìm thấy
                    </div>
                    <div class="sort-text mb-15 me-4">
                        Sắp xếp theo
                    </div>
                    <select>
                        <option value="default" selected="">Sắp xếp theo</option>
                        <option value="new">Mới nhất</option>
                        <option value="old">Cũ nhất</option>
                        <option value="hight-to-low">Cao đến thấp</option>
                        <option value="low-to-high">Thấp đến cao</option>
                    </select>
                </div>

                <div class="tour-grid-wrap">
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="destination-item tour-grid style-three bgc-lighter" data-aos="fade-up"
                                data-aos-duration="1500" data-aos-offset="50">
                                <div class="image">
                                    <span class="badge bgc-pink">Featured</span>
                                    <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                    <img src="{{ asset('clients/assets/images/destinations/tour-list1.jpg') }}" alt="Tour List">
                                </div>
                                <div class="content">
                                    <div class="destination-header">
                                        <span class="location"><i class="fal fa-map-marker-alt"></i> Bali,
                                            Indonesia</span>
                                        <div class="ratting">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                    <h6><a href="tour-details.html">Bay Cruise trip by Boat's in Bali, Indonesia</a>
                                    </h6>
                                    <ul class="blog-meta">
                                        <li><i class="far fa-clock"></i> 3 days 2 nights</li>
                                        <li><i class="far fa-user"></i> 5-8 guest</li>
                                    </ul>
                                    <div class="destination-footer">
                                        <span class="price"><span>$58.00</span>/person</span>
                                        <a href="tour-details.html" class="theme-btn style-two style-three">
                                            <i class="fal fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <ul class="pagination justify-content-center pt-15 flex-wrap" data-aos="fade-up"
                                data-aos-duration="1500" data-aos-offset="50">
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="far fa-chevron-left"></i></span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">
                                        1
                                        <span class="sr-only">(current)</span>
                                    </span>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="far fa-chevron-right"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Tour Grid Area end -->
@include('clients.block.footer_2')
