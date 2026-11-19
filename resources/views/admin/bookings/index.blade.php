@include('admin.block.header', ['title' => 'Quản lý đơn đặt tour'])

<main class="container-fluid px-4 py-4">
    <h1 class="h4 mb-4">Quản lý đơn đặt tour</h1>

    {{-- Thông báo sau khi xác nhận đơn --}}
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

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.bookings.index') }}" class="row g-3 align-items-end mb-4">

                <div class="col-12 col-md-6">
                    <label for="keyword" class="form-label">Tìm đơn đặt tour</label>
                    <input type="search" id="keyword" name="keyword" class="form-control" maxlength="100"
                        value="{{ $keyword }}" placeholder="Mã đơn, tên khách, email, SĐT hoặc tên tour">

                    @error('keyword')
                        <small class="text-danger" role="alert">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-12 col-md-3">
                    <label for="status" class="form-label">Trạng thái</label>
                    <select id="status" name="status" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        @foreach ($statusLabels as $code => $label)
                            <option value="{{ $code }}" @selected($status === $code)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>

                    @error('status')
                        <small class="text-danger" role="alert">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-12 col-md-3 d-flex flex-wrap gap-2">
                    <button class="btn btn-success" type="submit">Tìm kiếm</button>
                    <a class="btn btn-outline-secondary" href="{{ route('admin.bookings.index') }}">Xóa bộ lọc</a>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Mã đơn</th>
                            <th>Tour / Ngày đặt</th>
                            <th>Thông tin liên hệ</th>
                            <th>Số khách</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.bookings.show', ['bookingid' => $booking->bookingid]) }}">
                                        #{{ $booking->bookingid }}
                                    </a>
                                </td>

                                <td>
                                    <a href="{{ route('admin.bookings.show', ['bookingid' => $booking->bookingid]) }}"
                                        class="fw-semibold admin-tour-link">
                                        {{ $booking->tour_title ?? 'Tour không còn hiển thị' }}
                                    </a>

                                    <div class="small text-muted mt-1">
                                        {{ $booking->bookingDate?->format('d/m/Y H:i') ?? 'Chưa cập nhật' }}
                                    </div>
                                </td>

                                <td>
                                    <div>{{ $booking->contactName }}</div>
                                    <div>{{ $booking->contactPhone }}</div>
                                    <div class="small text-muted">
                                        {{ $booking->contactEmail }}
                                    </div>
                                </td>

                                <td class="text-nowrap">
                                    <div>{{ $booking->numAdults }} người lớn</div>
                                    <div>{{ $booking->numChildren }} trẻ em</div>
                                </td>

                                <td class="text-nowrap">
                                    <strong>
                                        {{ number_format($booking->totalPrice, 0, ',', '.') }}
                                        VND
                                    </strong>
                                </td>

                                <td class="text-nowrap">
                                    {{ $statusLabels[$booking->bookingStatus] ?? 'Chưa xác định' }}
                                </td>

                                <td>
                                    @if ($booking->bookingStatus === 'pending')
                                        <form method="POST"
                                            action="{{ route('admin.bookings.confirm', ['bookingid' => $booking->bookingid]) }}"
                                            onsubmit="return confirm('Bạn muốn xác nhận đơn này?');">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit" class="btn btn-success btn-sm text-nowrap">
                                                Xác nhận đơn
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Chưa có đơn đặt tour nào.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $bookings->links('pagination::bootstrap-5') }}
        </div>
    </div>
</main>

@include('admin.block.footer')
