@include('admin.block.header', ['title' => 'Chi tiết đơn đặt tour'])

<main class="container-fluid px-4 py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <h1 class="h4 mb-0">
            Chi tiết đơn #{{ $booking->bookingid }}
        </h1>

        <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary">
            Về danh sách đơn
        </a>
    </div>

    @if (session('admin_success'))
        <div class="alert alert-success" role="alert">
            {{ session('admin_success') }}
        </div>
    @endif

    @if (session('admin_error'))
        <p class="text-danger" role="alert">
            {{ session('admin_error') }}
        </p>
    @endif

    <div class="row g-3">
        <div class="col-12 col-lg-6">
            <section class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h2 class="h5 mb-3">Thông tin đơn</h2>

                    <p>
                        Tour:
                        <strong>
                            {{ $booking->tour_title ?? 'Tour không còn hiển thị' }}
                        </strong>
                    </p>

                    <p>Mã tour: #{{ $booking->tourid }}</p>
                    <p>Mã người đặt: #{{ $booking->userid }}</p>

                    <p>
                        Ngày đặt:
                        {{ $booking->bookingDate?->format('d/m/Y H:i') ?? 'Chưa cập nhật' }}
                    </p>

                    <p class="mb-0">
                        Trạng thái:
                        <strong>
                            {{ $statusLabels[$booking->bookingStatus] ?? 'Chưa xác định' }}
                        </strong>
                    </p>
                </div>
            </section>
        </div>

        <div class="col-12 col-lg-6">
            <section class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h2 class="h5 mb-3">Thông tin liên hệ</h2>

                    <p>Họ và tên: {{ $booking->contactName }}</p>
                    <p>Email: {{ $booking->contactEmail }}</p>
                    <p>Số điện thoại: {{ $booking->contactPhone }}</p>

                    <p class="mb-0">
                        Địa chỉ:
                        {{ $booking->contactAddress ?: 'Chưa cung cấp' }}
                    </p>
                </div>
            </section>
        </div>
    </div>

    <section class="card border-0 shadow-sm mt-3">
        <div class="card-body p-4">
            <h2 class="h5 mb-3">Số khách và chi phí</h2>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Loại khách</th>
                            <th>Số lượng</th>
                            <th class="text-end">Đơn giá lúc đặt</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Người lớn</td>
                            <td>{{ $booking->numAdults }}</td>
                            <td class="text-end text-nowrap">
                                {{ number_format($booking->unitPriceAdult, 0, ',', '.') }}
                                VNĐ
                            </td>
                        </tr>

                        <tr>
                            <td>Trẻ em</td>
                            <td>{{ $booking->numChildren }}</td>
                            <td class="text-end text-nowrap">
                                {{ number_format($booking->unitPriceChild, 0, ',', '.') }}
                                VNĐ
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p class="text-end">
                Tổng tiền:
                <strong class="text-success">
                    {{ number_format($booking->totalPrice, 0, ',', '.') }}
                    VNĐ
                </strong>
            </p>

            <p>
                Phương thức thanh toán:
                {{ $paymentLabels[$booking->paymentMethod] ?? 'Chưa cập nhật' }}
            </p>

            <p class="small text-muted">
                Phương thức thanh toán không thể hiện đơn đã được thanh toán.
            </p>

            <hr>

            <h2 class="h5">Ghi chú của khách</h2>
            <p class="text-break">
                {{ $booking->specialRequests ?: 'Không có ghi chú.' }}
            </p>

            @if ($booking->bookingStatus === 'pending')
                <div class="d-flex flex-wrap gap-2">
                    <form method="POST"
                        action="{{ route('admin.bookings.confirm', ['bookingid' => $booking->bookingid]) }}"
                        onsubmit="return confirm('Bạn muốn xác nhận đơn này?');">
                        @csrf
                        @method('PATCH')

                        <button type="submit" class="btn btn-success">Xác nhận đơn</button>
                    </form>

                    <form method="POST"
                        action="{{ route('admin.bookings.cancel', ['bookingid' => $booking->bookingid]) }}"
                        onsubmit="return confirm('Bạn có chắc muốn hủy đơn này?');">
                        @csrf
                        @method('PATCH')

                        <button type="submit" class="btn btn-outline-danger">Hủy đơn</button>
                    </form>
                </div>
            @endif
        </div>
    </section>
</main>

@include('admin.block.footer')
