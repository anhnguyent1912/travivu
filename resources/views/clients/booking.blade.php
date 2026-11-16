<!DOCTYPE html>
<html lang="vi">
@include('clients.block.header_2')

<main class="booking-success-page">
    <div class="checkout-container">
        <h1 class="h2 mb-3">Tour đã đặt</h1>
        <p class="mb-4">Theo dõi các đơn đặt tour của bạn.</p>
        @if (session('booking_success'))
            <div class="alert alert-success" role="alert">
                {{ session('booking_success') }}
            </div>
        @endif

        @if (session('booking_error'))
            <p class="text-danger" role="alert">
                {{ session('booking_error') }}
            </p>
        @endif
        @forelse ($bookings as $booking)
            <div class="checkout-box">
                <div class="d-flex flex-wrap justify-content-between gap-2 mb-3">
                    <strong>Đơn #{{ $booking->bookingid }}</strong>

                    <span>
                        {{ $statusLabels[$booking->bookingStatus] ?? 'Đang cập nhật' }}
                    </span>
                </div>

                <h2>
                    {{ $booking->tour_title ?? 'Tour không còn hiển thị' }}
                </h2>

                <div class="row">
                    <div class="col-md-8">
                        <p>
                            Ngày đặt:
                            {{ $booking->bookingDate?->format('d/m/Y H:i') ?? 'Chưa cập nhật' }}
                        </p>

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
                    </div>

                    <div class="col-md-4 text-md-end">
                        <a href="{{ route('booking.success', ['bookingid' => $booking->bookingid]) }}"
                            class="theme-btn style-three">
                            <span data-hover="Xem chi tiết">Xem chi tiết</span>
                            <i class="fal fa-arrow-right" aria-hidden="true"></i>
                        </a>
                        @if ($booking->bookingStatus === 'pending')
                            <form action="{{ route('booking.cancel', ['bookingid' => $booking->bookingid]) }}"
                                method="POST" class="mt-2"
                                onsubmit="return confirm('Bạn có chắc muốn hủy đơn này?');">
                                @csrf
                                @method('PATCH')

                                <button type="submit" class="theme-btn style-three">
                                    <span data-hover="Hủy đơn">Hủy đơn</span>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="checkout-box text-center">
                <h2>Bạn chưa đặt tour nào</h2>
                <p>Khám phá các chuyến đi và chọn tour phù hợp với bạn.</p>

                <a href="{{ route('Tour') }}" class="theme-btn">
                    <span data-hover="Khám phá tour">Khám phá tour</span>
                </a>
            </div>
        @endforelse

        {{ $bookings->links('pagination::bootstrap-5') }}
    </div>
</main>
@include('clients.block.footer', ['disableAos' => true])
