{{-- Biểu đồ dùng số liệu có sẵn --}}
@php
    // Lấy mã của 3 nhóm theo thứ tự.
    $codes = array_keys($labels);

    // Lấy số lượng từng nhóm.
    $a = (int) $counts->get($codes[0], 0);
    $b = (int) $counts->get($codes[1], 0);
    $c = (int) $counts->get($codes[2], 0);

    $total = $a + $b + $c;

    // Mặc định màu xám khi chưa có dữ liệu.
    $background = '#e9eef3';

    if ($total > 0) {
        $endA = $a / $total * 100;
        $endB = ($a + $b) / $total * 100;

        $background = "conic-gradient(
            {$colors[0]} 0% {$endA}%,
            {$colors[1]} {$endA}% {$endB}%,
            {$colors[2]} {$endB}% 100%
        )";
    }
@endphp

<div class="dashboard-chart">
    <div class="dashboard-donut" style="background: {{ $background }};" aria-hidden="true">
        <div>
            <strong>{{ number_format($total, 0, ',', '.') }}</strong>
            <span>{{ $unit }}</span>
        </div>
    </div>
    <p class="small text-muted mt-2 mb-0 text-center">
        {{ $total > 0 ? 'Tổng: ' . number_format($total, 0, ',', '.') . ' ' . $unit : 'Chưa có dữ liệu' }}
    </p>
</div>
