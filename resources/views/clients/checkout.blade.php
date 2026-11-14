@include('clients.block.header_2')
<section class="checkout-page">
    <div class="checkout-container">
        {{-- <nav class="checkout-breadcrumb" aria-label="Đường dẫn">
            <a href="{{ route('home') }}">Trang chủ</a>
            <span aria-hidden="true">›</span>
            <a href="{{ route('tour-detail', ['id' => $tour->tourid]) }}">
                Chi tiết tour
            </a>
            <span aria-hidden="true">›</span>
            <span aria-current="page">{{ $title }}</span>
        </nav> --}}
        <h1>Thông tin đặt tour</h1>
        <p class="checkout-description">
            Kiểm tra chuyến đi và điền thông tin liên hệ của bạn.
        </p>
        <form action="{{ route('booking.store', ['tourid' => $tour->tourid]) }}"
            method="POST" novalidate>
            @csrf

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="text-danger" role="alert">{{ $error }}</p>
                @endforeach
            @endif
            <div class="checkout-layout">
                <!-- tt khách hàng -->
                <div class="checkout-content">
                    <div class="checkout-box">
                        <h2>Thông tin liên hệ</h2>
                        <div class="checkout-fields">
                            <label>
                                Họ và tên *
                                <input name="contactName"
                                    type="text"value="{{ old('contactName', auth()->user()?->fullname) }}"
                                    placeholder="Nhập họ và tên" maxlength="100" required>
                            </label>
                            <label>
                                Email *
                                <input name="contactEmail"
                                    type="email"value="{{ old('contactEmail', auth()->user()?->email) }}"
                                    placeholder="Nhập email" maxlength="255" required>
                            </label>
                            <label>
                                Số điện thoại *
                                <input name="contactPhone"
                                    type="tel"value="{{ old('contactPhone', auth()->user()?->phoneNumber) }}"
                                    placeholder="Nhập số điện thoại" maxlength="10" required>
                            </label>
                            <label>
                                Địa chỉ liên hệ
                                <input name="contactAddress" type="text"
                                    value="{{ old('contactAddress', auth()->user()?->address) }}"
                                    placeholder="Không bắt buộc" maxlength="255">
                            </label>
                        </div>
                    </div>
                    <div class="checkout-box">
                        <h2>Số lượng hành khách</h2>

                        <div class="checkout-fields">
                            <label>
                                Người lớn
                                <input name="adult_quantity" type="number" value="{{ old('adult_quantity', $numAdults) }}" data-price="{{ $unitPriceAdult }}" min="1" max="100" step="1" required>
                                <small>
                                    {{ number_format($unitPriceAdult, 0, ',', '.') }} VND / người
                                </small>
                            </label>

                            <label>
                                Trẻ em
                                <input name="child_quantity" type="number" value="{{ old('child_quantity', $numChildren) }}" data-price="{{ $unitPriceChild }}" min="0" max="100" step="1" required>
                                <small>
                                    {{ number_format($unitPriceChild, 0, ',', '.') }} VND / người
                                </small>
                            </label>
                        </div>
                    </div>
                    <div class="checkout-box">
                        <h2>Ghi chú thêm</h2>
                        <label>
                            Yêu cầu cần lưu ý (không bắt buộc)
                            <textarea name="specialRequests" rows="4" maxlength="255"
                                placeholder="Nhập yêu cầu hoặc ghi chú cho chuyến đi...">{{ old('specialRequests') }}</textarea>
                        </label>
                    </div>
                    <div class="checkout-box">
                        <h2>Phương thức thanh toán</h2>
                        <label class="payment-option">
                            <input type="radio" name="paymentMethod" value="office" @checked(old('paymentMethod', 'office') === 'office')>
                            <span>Thanh toán tại văn phòng</span>
                        </label>
                        <label class="payment-option">
                            <input type="radio" name="paymentMethod" value="bank" @checked(old('paymentMethod', 'office') === 'bank')>
                            <span>Chuyển khoản ngân hàng</span>
                        </label>
                        <p class="payment-note">
                            Bạn sẽ được hướng dẫn thanh toán sau khi đơn được xác nhận.
                        </p>
                    </div>
                </div>
                <!-- tt đơn -->
                <aside class="checkout-box checkout-summary">
                    <h2>Chuyến đi của bạn</h2>
                    <small>Mã tour: {{ $tour->tourid }}</small>
                    <h3>{{ $tour->title }}</h3>
                    <p>Khởi hành:
                        {{ $tour->startDate ? \Carbon\Carbon::parse($tour->startDate)->format('d/m/Y') : 'Chưa cập nhật' }}
                    </p>
                    <p>Kết thúc:
                        {{ $tour->endDate ? \Carbon\Carbon::parse($tour->endDate)->format('d/m/Y') : 'Chưa cập nhật' }}
                    </p>
                    <p>Thời lượng: {{ $tour->time }}</p>
                    <hr>
                    <div class="checkout-price-row">
                        <span>Người lớn × <span id="checkout-adults">{{ $numAdults }}</span>
                    </span>
                        <strong id="checkout-adult-total">
                            {{ number_format($adultTotal, 0, ',', '.') }} VND
                        </strong>
                    </div>
                    <div class="checkout-price-row">
                        <span>Trẻ em × <span id="checkout-children">{{ $numChildren }}</span>
                    </span>
                        <strong id="checkout-child-total">
                            {{ number_format($childTotal, 0, ',', '.') }} VND
                        </strong>
                    </div>
                    <hr>
                    <p>Tổng tiền dự kiến</p>
                    <div class="checkout-total">
                        <strong id="checkout-total-price">
                            {{ number_format($totalPrice, 0, ',', '.') }}
                        </strong>
                        <span>VND</span>
                    </div>
                    <button type="submit" class="checkout-submit">
                        Xác nhận đặt tour
                    </button>
                </aside>
            </div>
        </form>
    </div>
</section>
@include('clients.block.footer_2', ['disableAos' => true])
