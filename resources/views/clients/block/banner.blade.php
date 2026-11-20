<section class="hero-area bgc-black pt-120 rpt-120 rel z-2">
    <div class="container-fluid">
        {{-- <h1 class="hero-title" data-aos="flip-up" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
            Tours Du Lịch</h1> --}}
        <div class="main-hero-image bgs-cover"
            style="background-image: url({{ asset('clients/assets/images/banner/banner3.jpg') }});">
        </div>
    </div>
    <form action="{{ route('search') }}" method="GET" id="search_form">
        <div class="container container-1400">
            <div class="search-filter-inner" data-aos="zoom-out-down" data-aos-duration="1500" data-aos-offset="50">
                <div class="filter-item clearfix">
                    <div class="icon"><i class="fal fa-map-marker-alt"></i></div>
                    <span class="title">Điểm đến</span>
                    <select name="destination" id="destination">
                        <option value="">Tất cả điểm đến</option>
                        @foreach ($searchDestinations as $destination)
                            <option value="{{ $destination }}" @selected(old('destination') === $destination)>
                                {{ $destination }}
                            </option>
                        @endforeach
                    </select>

                </div>
                <div class="filter-item clearfix">
                    <label for="start_date" class="title">Ngày khởi hành</label>
                    <input type="date" id="start_date" name="start_date"
                        min="{{ today()->toDateString() }}" value="{{ old('start_date') }}">
                </div>
                <div class="search-button">
                    <button class="theme-btn" type="submit">
                        <span data-hover="Tìm kiếm">Tìm kiếm</span>
                        <i class="far fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>

</section>
