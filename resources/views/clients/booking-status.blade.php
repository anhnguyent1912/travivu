<!DOCTYPE html>
<html lang="vi">
@include('clients.block.header_2')

<main class="booking-success-page">
    <div class="checkout-container">
        <div class="checkout-box">
            @if (session('booking_success'))
                <div class="alert alert-success" role="status">
                    {{ session('booking_success') }}
                </div>
            @endif

            <h1 class="h2 mb-3">Thông tin đơn đặt tour</h1>

            <p>
                Mã đơn:
                <strong>#{{ $booking->bookingid }}</strong>
            </p>

            <p>
                Tour:
                <strong>{{ $tour?->title ?? 'Tour không còn hiển thị' }}</strong>
            </p>

            <p>
                Trạng thái:
                <strong>{{ $statusText }}</strong>
            </p>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <h2>Thông tin liên hệ</h2>

                    <p>Họ và tên: {{ $booking->contactName }}</p>
                    <p>Email: {{ $booking->contactEmail }}</p>
                    <p>Số điện thoại: {{ $booking->contactPhone }}</p>
                </div>

                <div class="col-md-6">
                    <h2>Thông tin đặt tour</h2>

                    <p>
                        Số khách:
                        {{ $booking->numAdults }} người lớn,
                        {{ $booking->numChildren }} trẻ em
                    </p>

                    <p>
                        Tổng tiền:
                        <strong>
                            {{ number_format($booking->totalPrice, 0, ',', '.') }}
                            VND
                        </strong>
                    </p>

                    <p>
                        Phương thức thanh toán:
                        @switch($booking->paymentMethod)
                            @case('office')
                                Thanh toán tại văn phòng
                                @break
                            @case('bank')
                                Chuyển khoản ngân hàng
                                @break
                            @default
                                Chưa cập nhật
                        @endswitch
                    </p>
                </div>
            </div>

            @if ($booking->specialRequests)
                <p>Ghi chú: {{ $booking->specialRequests }}</p>
            @endif

            <hr>

            <p>
                Việc tạo đơn không có nghĩa là đã thanh toán.
                Bạn sẽ được hướng dẫn thanh toán sau khi đơn được xác nhận.
            </p>

            <div class="d-flex flex-wrap gap-3">
                <a href="{{ route('booking.index') }}" class="theme-btn style-three">
                    <i class="fal fa-arrow-left me-2 ms-0" aria-hidden="true"></i>
                    <span data-hover="Về tour đã đặt">Về tour đã đặt</span>
                </a>

                <a href="{{ route('home') }}" class="theme-btn">
                    <span data-hover="Về trang chủ">Về trang chủ</span>
                </a>
            </div>
        </div>
    </div>
</main>

@include('clients.block.footer', ['disableAos' => true])
