@include('clients.block.header_2')
@include('clients.block.banner_2')

<!-- Tour Grid Area start -->
<section class="tour-grid-page py-100 rel z-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-10 rmb-75">
                <form id="tour-filter-form" class="shop-sidebar" method="GET" action="{{ route('Tour') }}">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <div class="div_filter_clear">
                        <a href="{{ route('Tour') }}" class="clear_filter">Xóa bộ lọc</a>
                    </div>
                    <div class="widget widget-filter" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500"
                        data-aos-offset="50">
                        <h6 class="widget-title">Lọc theo giá</h6>
                        <div class="price-filter-wrap">
                            <div class="price-slider-range"></div>
                            <div class="price">
                                <span>Giá tiền</span>
                                <input type="text" id="price" readonly>
                            </div>
                            <input type="hidden" name="min_price" id="min_price"
                                value="{{ request('min_price', 100000) }}">
                            <input type="hidden" name="max_price" id="max_price"
                                value="{{ request('max_price', 10000000) }}">
                        </div>
                    </div>
                    <div class="widget widget-activity" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-offset="50">
                        <h6 class="widget-title">Điểm đến</h6>
                        <ul class="radio-filter">
                            <li>
                                <input class="form-check-input" type="radio" name="domain" id="domain_all"
                                    value="" @checked(!request()->filled('domain'))>
                                <label for="domain_all">Tất cả</label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="domain" id="domain_b"
                                    value="b" @checked(request('domain') === 'b')>
                                <label for="domain_b">Miền Bắc <span>{{ $domain->get('b', 0) }}</span></label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="domain" id="domain_t"
                                    value="t" @checked(request('domain') === 't')>
                                <label for="domain_t">Miền Trung <span>{{ $domain->get('t', 0) }}</span></label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="domain" id="domain_n"
                                    value="n" @checked(request('domain') === 'n')>
                                <label for="domain_n">Miền Nam <span>{{ $domain->get('n', 0) }}</span></label>
                            </li>
                        </ul>
                    </div>
                    <div class="widget widget-reviews" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <h6 class="widget-title">Đánh giá</h6>
                        <ul class="radio-filter">
                            <li>
                                <input class="form-check-input" type="radio" name="rating" id="rating_all"
                                    value="" @checked(!request()->filled('rating'))>
                                <label for="rating_all">Tất cả</label>
                            </li>
                            @foreach ([5, 4, 3, 2, 1] as $star)
                                <li>
                                    <input class="form-check-input" type="radio" name="rating"
                                        id="rating_{{ $star }}" value="{{ $star }}"
                                        @checked(request('rating') == $star)>
                                    <label for="rating_{{ $star }}">
                                        <span class="ratting" aria-hidden="true">
                                            @for ($i = 1; $i <= $star; $i++)
                                                <i class="fas fa-star"></i>
                                            @endfor
                                        </span>
                                        <span>
                                            {{ $star }} sao
                                        </span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="widget widget-languages" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-offset="50">
                        <h6 class="widget-title">Thời gian</h6>
                        <ul class="radio-filter">
                            <li>
                                <input class="form-check-input" type="radio" name="duration" id="duration_all"
                                    value="" @checked(!request()->filled('duration'))>
                                <label for="duration_all">Tất cả</label>
                            </li>
                            @foreach ([
        '1n1d' => '1 ngày 1 đêm',
        '3n2d' => '3 ngày 2 đêm',
        '4n3d' => '4 ngày 3 đêm',
        '5n4d' => '5 ngày 4 đêm',
    ] as $value => $label)
                                <li>
                                    <input class="form-check-input" type="radio" name="duration"
                                        id="duration_{{ $value }}" value="{{ $value }}"
                                        @checked(request('duration') === $value)>
                                    <label for="duration_{{ $value }}">
                                        {{ $label }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="submit" class="theme-btn mt-20">
                        <span data-hover="Lọc tour">Lọc tour</span>
                        <i class="fal fa-filter"></i>
                    </button>
                </form>

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
                    <div class="cta-shape"><img src="{{ asset('clients/assets/images/widgets/cta-shape2.png') }}"
                            alt="Shape"></div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop-shorter rel z-3 mb-20">
                    <div class="sort-text mb-15 me-4 me-xl-auto">
                        Tìm thấy {{ $tours->total() }} tour
                    </div>
                    <div class="sort-text mb-15 me-4">
                        Sắp xếp theo
                    </div>
                    <select name="sort" form="tour-filter-form" aria-label="Sắp xếp tour"
                        onchange="this.form.requestSubmit()">
                        <option value="default" @selected(request('sort', 'default') === 'default')>
                            Mặc định
                        </option>
                        <option value="new" @selected(request('sort') === 'new')>
                            Mới nhất
                        </option>
                        <option value="old" @selected(request('sort') === 'old')>
                            Cũ nhất
                        </option>
                        <option value="high-to-low" @selected(request('sort') === 'high-to-low')>
                            Giá cao đến thấp
                        </option>
                        <option value="low-to-high" @selected(request('sort') === 'low-to-high')>
                            Giá thấp đến cao
                        </option>
                    </select>
                </div>

                <div class="tour-grid-wrap">
                    <div class="row">
                        @forelse ($tours as $tour)
                            <div class="col-xl-4 col-md-6">
                                <div class="destination-item tour-grid style-three bgc-lighter" data-aos="fade-up"
                                    data-aos-duration="1500" data-aos-offset="50">
                                    <div class="image">
                                        <span class="badge bgc-pink">yêu thích</span>
                                        <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                        <img src="{{ asset('clients/assets/images/image-tour/' . $tour->images->first()) }}"
                                            alt="Tour List">
                                    </div>
                                    <div class="content">
                                        <div class="destination-header">
                                            <span class="location"><i class="fal fa-map-marker-alt"></i>
                                                {{ $tour->destination }}</span>
                                            <div class="ratting">
                                                @if ($tour->average_rating !== null)
                                                    <i class="fas fa-star"></i>
                                                    <span>
                                                        {{ number_format((float) $tour->average_rating, 1, ',', '.') }}/5
                                                    </span>
                                                @else
                                                    <span>Chưa có đánh giá</span>
                                                @endif
                                            </div>
                                        </div>
                                        <h6><a
                                                href="{{ route('tour-detail', ['id' => $tour->tourid]) }}">{{ $tour->title }}</a>
                                        </h6>
                                        <ul class="blog-meta">
                                            <li><i class="far fa-clock"></i> {{ $tour->time }}</li>
                                            <li><i class="far fa-user"></i>{{ $tour->quantity }}</li>
                                        </ul>
                                        <div class="destination-footer">
                                            <span
                                                class="price"><span>{{ number_format($tour->priceAdult, 0, ',', '.') }}</span>VND
                                                / người</span>
                                            <a href="{{ route('tour-detail', ['id' => $tour->tourid]) }}"
                                                class="theme-btn style-two style-three">
                                                <i class="fal fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p>Không tìm thấy tour phù hợp. Bạn hãy thử thay đổi bộ lọc.</p>
                            </div>
                        @endforelse
                        <div class="col-12 mt-30">
                            {{ $tours->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- Tour Grid Area end -->
@include('clients.block.footer_2')
