<aside class="admin-sidebar">
    <h2 class="h4 mb-4">Vivutravel Admin</h2>

    <p class="small mb-1">Xin chào,</p>
    <p class="fw-bold mb-4">
        {{ Auth::guard('admin')->user()->userName }}
    </p>

    <p class="small text-uppercase">Quản lý website</p>

    <nav aria-label="Menu quản trị">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            Dashboard
        </a>
        <details class="admin-menu" open>
            <summary>Quản lý tour</summary>

            <div class="ps-3">
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    Danh sách đặt tour
                </a>

                <a href="{{ route('admin.bookings.index') }}"
                    class="{{ request()->routeIs('admin.bookings.*') ? 'active' : '' }}">
                    Đơn đặt tour
                </a>
            </div>
        </details>
    </nav>
</aside>
