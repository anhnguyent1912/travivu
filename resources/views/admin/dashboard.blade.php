@include('admin.block.header', ['title' => 'Trang quản trị'])

<main class="container py-4">
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
</main>

@include('admin.block.footer')
