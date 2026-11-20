@include('admin.block.header', ['title' => 'Quản lý khách hàng'])

<main class="customer-list container-fluid px-3 px-md-4 py-4">
    <h1 class="h4 mb-4">Quản lý khách hàng</h1>

    @if (session('admin_success'))
        <div class="alert alert-success" role="alert">{{ session('admin_success') }}</div>
    @endif
    @if (session('admin_error'))
        <div class="alert alert-danger" role="alert">{{ session('admin_error') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-3 p-md-4">
            <form method="GET" action="{{ route('admin.users.index') }}"
                  class="row g-2 align-items-end mb-3">
                <div class="col-12 col-md-6">
                    <label for="keyword" class="form-label">Tìm khách hàng</label>
                    <input type="search" id="keyword" name="keyword"
                           class="form-control" maxlength="100"
                           value="{{ $keyword }}" placeholder="Tên đăng nhập hoặc email">

                    @error('keyword')
                        <small class="text-danger" role="alert">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-12 col-md-auto d-flex gap-2">
                    <button type="submit" class="btn btn-success">Tìm kiếm</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                        Xóa bộ lọc
                    </a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Mã khách</th>
                            <th>Tên đăng nhập</th>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="text-muted">#{{ $user->userid }}</td>
                                <td class="fw-bold text-break">{{ $user->username }}</td>
                                <td>{{ $user->fullname ?: 'Chưa cập nhật' }}</td>
                                <td class="text-break">{{ $user->email }}</td>
                                <td>
                                    @if ($user->status === 'b')
                                        <span class="dashboard-status customer-locked">Đã khóa</span>
                                    @elseif ($user->status === 'd')
                                        <span class="dashboard-status">Đã xóa</span>
                                    @elseif ($user->isActive === 'Y')
                                        <span class="dashboard-status dashboard-status-confirmed">Đã kích hoạt</span>
                                    @else
                                        <span class="dashboard-status dashboard-status-pending">Chưa kích hoạt</span>
                                    @endif
                                    @if ($user->isActive === 'n' && $user->status === null)
                                        <form method="POST" class="mt-2"
                                              action="{{ route('admin.users.activate', ['userid' => $user->userid]) }}"
                                              onsubmit="return confirm('Kích hoạt tài khoản khách hàng này?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-outline-success btn-sm">Kích hoạt</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    {{ $keyword !== '' ? 'Không tìm thấy khách hàng phù hợp.' : 'Chưa có khách hàng.' }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($users->hasPages())
                <div class="mt-3">{{ $users->links('pagination::bootstrap-5') }}</div>
            @endif
        </div>
    </div>
</main>

@include('admin.block.footer')
