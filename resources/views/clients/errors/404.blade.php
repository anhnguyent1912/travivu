<!DOCTYPE html>
<html lang="vi">
@php($title = 'Không tìm thấy trang')
@include('clients.block.header_2')

<main class="error-page py-70" aria-labelledby="error-heading">
    <div class="container">
        <div class="row align-items-center justify-content-between gy-5">
            <div class="col-lg-6">
                <p class="error-page-code mb-15" aria-label="Lỗi 404">404</p>
                <h1 id="error-heading" class="mb-20">Có vẻ bạn đã lạc đường!</h1>
                <p class="mb-30">
                    Trang bạn đang tìm có thể đã được di chuyển, bị xóa hoặc đường dẫn chưa chính xác.
                    Hãy trở về trang chủ hoặc khám phá những tour du lịch đang có tại Travivu.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('home') }}" class="theme-btn style-two bgc-secondary">
                        <span data-hover="Về trang chủ">Về trang chủ</span>
                        <i class="fal fa-home" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('Tour') }}" class="theme-btn style-three">
                        <span data-hover="Khám phá tour">Khám phá tour</span>
                        <i class="fal fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
                <p class="mt-25 mb-0">
                    Bạn cần hỗ trợ? <a class="error-page-contact" href="{{ route('contact') }}">Liên hệ với chúng tôi</a>.
                </p>
            </div>
            <div class="col-lg-5 text-center">
                <img class="error-page-image"
                    src="{{ asset('clients/assets/images/newsletter/404.png') }}"
                    alt="Du khách mang hành lý khám phá điểm đến mới"
                    width="520" height="636">
            </div>
        </div>
    </div>
</main>

@include('clients.block.footer_2', ['disableAos' => true])
