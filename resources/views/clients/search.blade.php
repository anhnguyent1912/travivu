<!DOCTYPE html>
<html lang="vi">
@include('clients.block.header_2')
@include('clients.block.banner_2')

<section class="tour-grid-page py-100 rel z-1">
    <div class="container">
        <div class="shop-shorter mb-20">
            <p class="sort-text mb-0">
                Tìm thấy <strong>{{ $tours->total() }}</strong> tour
                @if (request()->filled('destination'))
                    tại <strong>{{ request('destination') }}</strong>
                @endif
                @if (request()->filled('start_date'))
                    khởi hành ngày <strong>{{ request()->date('start_date')->format('d/m/Y') }}</strong>
                @endif
            </p>
        </div>

        @include('clients.block.tour-grid', ['tours' => $tours])
    </div>
</section>

@include('clients.block.footer', ['disableAos' => true])
