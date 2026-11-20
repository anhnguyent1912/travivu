@include('admin.block.header', ['title' => 'Danh sách tour'])

<main class="container-fluid px-4 py-4">
    <h1 class="h4 mb-4">Danh sách tour</h1>
    <a href="{{ route('admin.tours.create') }}" class="btn btn-success mb-3">
        Thêm tour
    </a>

    @if (session('admin_success'))
        <div class="alert alert-success" role="status">{{ session('admin_success') }}</div>
    @endif

    @if (session('admin_error'))
        <p class="text-danger" role="alert">{{ session('admin_error') }}</p>
    @endif

    @error('availability')
        <p class="text-danger" role="alert">{{ $message }}</p>
    @enderror

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Mã tour</th>
                            <th>Tour / Khu vực</th>
                            <th>Khởi hành</th>
                            <th>Giá mỗi người</th>
                            <th>Chỗ còn / tổng</th>
                            <th>Nhận đặt</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($tours as $tour)
                            @php
                                $isOpen = (int) $tour->availability === 1;
                                $remaining = max(0, $tour->quantity - $tour->reserved_seats);
                                $canOpen = $tour->startDate && $tour->startDate > today()->toDateString();
                            @endphp

                            <tr>
                                <td>#{{ $tour->tourid }}</td>

                                <td>
                                    <strong>{{ $tour->title }}</strong>
                                    <div class="small text-muted">
                                        {{ $domainLabels[$tour->domain] ?? 'Chưa cập nhật' }}
                                    </div>
                                </td>

                                <td class="text-nowrap">
                                    {{ $tour->startDate ? \Carbon\Carbon::parse($tour->startDate)->format('d/m/Y') : 'Chưa có ngày' }}
                                </td>

                                <td class="text-nowrap">
                                    <div>Người lớn: {{ number_format($tour->priceAdult, 0, ',', '.') }} đ</div>
                                    <div class="small text-muted">
                                        Trẻ em: {{ number_format($tour->priceChild, 0, ',', '.') }} đ
                                    </div>
                                </td>

                                <td>{{ $remaining }} / {{ $tour->quantity }}</td>

                                <td>
                                    {{ $isOpen ? 'Đang mở' : 'Đã đóng' }}

                                    @if ($tour->startDate && !$canOpen)
                                        <div class="small text-muted">Đã đến hạn khởi hành</div>
                                    @elseif ($remaining === 0)
                                        <div class="small text-muted">Hết chỗ</div>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('admin.tours.edit', ['tourid' => $tour->tourid]) }}"
                                        class="btn btn-outline-primary btn-sm mb-2">
                                        Sửa
                                    </a>
                                    <form method="POST"
                                        action="{{ route('admin.tours.availability', ['tourid' => $tour->tourid]) }}">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="availability" value="{{ $isOpen ? 0 : 1 }}">

                                        <button type="submit"
                                            class="btn btn-sm text-nowrap {{ $isOpen ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                            @disabled(!$isOpen && !$canOpen)>
                                            {{ $isOpen ? 'Đóng nhận đặt' : 'Mở nhận đặt' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Chưa có tour nào.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $tours->links('pagination::bootstrap-5') }}
        </div>
    </div>
</main>

@include('admin.block.footer')
