@include('admin.block.header', ['title' => 'Trang quản trị'])

<main class="container-fluid dashboard-page p-3 p-lg-4">
    <section class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <h1 class="h4">Trang quản trị</h1>
            <a href="{{ route('admin.bookings.index') }}" class="btn btn-success">
                Quản lý đơn đặt tour
            </a>
        </div>
    </section>
    <div class="row g-3 mt-2">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Tour đang hoạt động</p>

                    <h2 class="h3 text-success mb-0">
                        {{ number_format($activeTours, 0, ',', '.') }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Tổng đơn đặt tour</p>

                    <h2 class="h3 mb-0">
                        {{ number_format($totalBookings, 0, ',', '.') }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-warning shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Đơn chờ xác nhận</p>

                    <h2 class="h3 text-warning mb-0">
                        {{ number_format($pendingBookings, 0, ',', '.') }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">Giá trị đơn đã xác nhận</p>

                    <h2 class="h3 text-success mb-0">
                        {{ number_format($confirmedValue, 0, ',', '.') }}
                        <small class="fs-6">VNĐ</small>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3 mt-2">
        {{-- Bảng thống kê khu vực --}}
        <div class="col-12 col-lg-6">
            <section class="card border-0 shadow-sm h-100 dashboard-summary">
                <div class="card-body">
                    <h2 class="h5 mb-3">Tour theo khu vực</h2>
                    <p class="small text-muted">Thống kê tất cả tour.</p>

                    <div class="dashboard-chart-content">
                        @include('admin.block.donut', [
                            'counts' => $domainCounts,
                            'labels' => $domainLabels,
                            'colors' => ['#4789c8', '#198754', '#9470c5'],
                            'unit' => 'tour',
                        ])
                        <div class="flex-grow-1">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Khu vực</th>
                                        <th class="text-end">Số tour</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($domainLabels as $code => $label)
                                        <tr>
                                            <td>{{ $label }}</td>
                                            <td class="text-end">
                                                {{ $domainCounts->get($code, 0) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        {{-- Bảng thống kê trạng thái đơn --}}
        <div class="col-12 col-lg-6">
            <section class="card border-0 shadow-sm h-100 dashboard-summary">
                <div class="card-body">
                    <h2 class="h5 mb-3">Đơn theo trạng thái</h2>
                    <p class="small text-muted">Thống kê số đơn ở từng trạng thái.</p>

                    <div class="dashboard-chart-content">
                        @include('admin.block.donut', [
                            'counts' => $statusCounts,
                            'labels' => $statusLabels,
                            'colors' => ['#d89018', '#198754', '#8b98a7'],
                            'unit' => 'đơn',
                        ])
                        <div class="flex-grow-1">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Trạng thái</th>
                                        <th class="text-end">Số đơn</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($statusLabels as $status => $label)
                                        <tr>
                                            <td>{{ $label }}</td>
                                            <td class="text-end">
                                                {{ $statusCounts->get($status, 0) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="row g-3 mt-2">
        {{-- 4 đơn mới nhất --}}
        <div class="col-12">
            <section class="card border-0 shadow-sm h-100 dashboard-summary">
                <div class="card-body">
                    <div class="dashboard-panel-heading d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <h2 class="h5 mb-2">4 đơn đặt mới nhất</h2>
                            <p class="small text-muted mb-0">Bao gồm tất cả trạng thái đơn.</p>
                        </div>

                        <a href="{{ route('admin.bookings.index') }}"
                            class="btn btn-outline-success btn-sm text-nowrap">
                            Xem tất cả
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="text-nowrap">Mã đơn</th>
                                    <th>Tour / Khách hàng</th>
                                    <th class="text-end">Tổng tiền</th>
                                    <th class="text-nowrap">Trạng thái</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($latestBookings as $booking)
                                    <tr>
                                        <td>
                                            <a
                                                href="{{ route('admin.bookings.show', ['bookingid' => $booking->bookingid]) }}">
                                                #{{ $booking->bookingid }}
                                            </a>
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.bookings.show', ['bookingid' => $booking->bookingid]) }}"
                                                class="fw-semibold admin-tour-link">
                                                {{ $booking->tour_title ?? 'Tour không còn hiển thị' }}
                                            </a>

                                            <div class="small text-muted">
                                                {{ $booking->contactName }}
                                            </div>

                                            <div class="small text-muted">
                                                {{ $booking->bookingDate?->format('d/m/Y H:i') ?? 'Chưa cập nhật' }}
                                            </div>
                                        </td>

                                        <td class="text-end text-nowrap">
                                            {{ number_format($booking->totalPrice, 0, ',', '.') }}
                                            VNĐ
                                        </td>

                                        <td class="text-nowrap">
                                            <span @class([
                                                'dashboard-status',
                                                'dashboard-status-pending' => $booking->bookingStatus === 'pending',
                                                'dashboard-status-confirmed' => $booking->bookingStatus === 'confirmed',
                                            ])>
                                                {{ $statusLabels[$booking->bookingStatus] ?? 'Chưa xác định' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            Chưa có đơn đặt tour.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

        {{-- 5 tour được đặt nhiều nhất --}}
        <div class="col-12">
            <section class="card border-0 shadow-sm h-100 dashboard-summary">
                <div class="card-body">
                    <div class="dashboard-panel-heading">
                        <h2 class="h5 mb-2">Tour được đặt nhiều nhất</h2>
                        <p class="small text-muted mb-0">Tối đa 5 tour, không tính đơn đã hủy.</p>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="text-nowrap">Mã tour</th>
                                    <th>Tên tour</th>
                                    <th class="text-end text-nowrap">Số đơn</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($popularTours as $popularTour)
                                    <tr>
                                        <td>#{{ $popularTour->tourid }}</td>

                                        <td>{{ $popularTour->title }}</td>

                                        <td class="text-end">
                                            {{ $popularTour->total_bookings }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4">
                                            Chưa có lượt đặt phù hợp.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

@include('admin.block.footer')
