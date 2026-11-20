<div class="tour-grid-wrap">
    <div class="row">
        @forelse ($tours as $tour)
            <div class="col-xl-4 col-md-6 d-flex">
                <div class="destination-item tour-grid style-three bgc-lighter">
                    <div class="image">
                        <span class="badge bgc-pink">yêu thích</span>
                        @if ($tour->images->isNotEmpty())
                            <img src="{{ asset('clients/assets/images/image-tour/' . $tour->images->first()) }}"
                                alt="{{ $tour->title }}">
                        @endif
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
                <p>Chưa có tour phù hợp với lựa chọn của bạn.</p>
            </div>
        @endforelse
        <div class="col-12 mt-30">
            {{ $tours->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
