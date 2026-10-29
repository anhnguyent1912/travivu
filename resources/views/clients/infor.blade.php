@include('clients.block.header_2')

@php
    $profile = auth()->user();
    $displayName = $profile?->fullname ?: ($profile?->username ?: 'Tài khoản của bạn');
    $initial = mb_strtoupper(mb_substr(trim($displayName), 0, 1));
    $hasGoogle = filled($profile?->googleid);
    $isActive = $profile?->isActive === 'Y';
@endphp

<main class="profile-page">
    <div class="profile-shell">
        <div class="profile-heading">
            <div>
                <h1>Thông tin cá nhân</h1>
                <p>Xem thông tin tài khoản và phương thức đăng nhập.</p>
            </div>
            <a class="profile-explore" href="{{ route('Tour') }}">Khám phá tour <i class="fal fa-arrow-up-right" aria-hidden="true"></i><span aria-hidden="true">↗</span></a>
        </div>

        @if ($profile)
            <div class="profile-layout">
                <aside class="profile-sidebar" aria-label="Tóm tắt tài khoản">
                    <section class="profile-card profile-identity">
                        <div class="profile-cover" aria-hidden="true"><span>TRAVIVU</span></div>
                        <div class="profile-identity-content">
                            <div class="profile-avatar" aria-hidden="true">{{ $initial }}</div>
                            <h2>{{ $displayName }}</h2>
                            <p class="profile-email">{{ $profile->email }}</p>
                            <span class="profile-badge {{ $isActive ? '' : 'profile-badge-pending' }}">
                                <i class="fas {{ $isActive ? 'fa-check-circle' : 'fa-clock' }}" aria-hidden="true"></i>
                                {{ $isActive ? 'Đã kích hoạt' : 'Chờ kích hoạt' }}
                            </span>
                            <div class="profile-account-id"><span>ID</span><strong>#{{ $profile->userid }}</strong></div>
                        </div>
                        <nav class="profile-nav" aria-label="Các mục hồ sơ">
                            <a href="#profile-details"><i class="far fa-user" aria-hidden="true"></i> Thông tin tài khoản <span aria-hidden="true">↗</span></a>
                            <a href="#profile-security"><i class="far fa-shield-check" aria-hidden="true"></i> Đăng nhập & bảo mật <span aria-hidden="true">↗</span></a>
                        </nav>
                    </section>
                    <div class="profile-tip"><i class="far fa-compass" aria-hidden="true"></i><div><strong>Hành trình mới đang chờ bạn</strong><p>Tìm một điểm đến yêu thích và lên kế hoạch cho chuyến đi tiếp theo.</p><a href="{{ route('Tour') }}">Xem các tour du lịch <span aria-hidden="true">→</span></a></div></div>
                </aside>

                <div class="profile-content">
                    <section id="profile-details" class="profile-card">
                        <div class="profile-card-heading"><span class="profile-section-icon"><i class="far fa-id-card" aria-hidden="true"></i></span><div><h2>Thông tin tài khoản</h2><p>Thông tin hiện tại của bạn trên Travivu.</p></div><span class="profile-readonly">Chỉ xem</span></div>
                        <div class="profile-card-body">
                            <div class="profile-fields">
                                <div class="profile-field"><label for="profile-fullname">Họ và tên</label><input id="profile-fullname" type="text" value="{{ $profile->fullname }}" placeholder="Chưa bổ sung" readonly></div>
                                <div class="profile-field"><label for="profile-username">Tên đăng nhập</label><input id="profile-username" type="text" value="{{ $profile->username }}" readonly></div>
                                <div class="profile-field profile-field-wide"><label for="profile-email">Địa chỉ email</label><input id="profile-email" type="email" value="{{ $profile->email }}" readonly><small>Email được sử dụng cho tài khoản của bạn.</small></div>
                                <div class="profile-field"><label for="profile-phone">Số điện thoại</label><input id="profile-phone" type="tel" value="{{ $profile->phoneNumber }}" placeholder="Chưa bổ sung" readonly></div>
                                <div class="profile-field"><label for="profile-address">Địa chỉ</label><input id="profile-address" type="text" value="{{ $profile->address }}" placeholder="Chưa bổ sung" readonly></div>
                            </div>
                            <div class="profile-notice"><i class="far fa-info-circle" aria-hidden="true"></i><p>Bạn đang xem thông tin đã lưu. Chức năng chỉnh sửa hồ sơ và đổi ảnh đại diện chưa khả dụng.</p></div>
                        </div>
                    </section>

                    <section id="profile-security" class="profile-card">
                        <div class="profile-card-heading"><span class="profile-section-icon"><i class="far fa-lock" aria-hidden="true"></i></span><div><h2>Đăng nhập & bảo mật</h2><p>Kiểm tra phương thức đăng nhập của tài khoản.</p></div></div>
                        <div class="profile-card-body">
                            <div class="profile-login-method"><span class="profile-method-icon" aria-hidden="true"><i class="{{ $hasGoogle ? 'fab fa-google' : 'far fa-envelope' }}"></i></span><div><h3>{{ $hasGoogle ? 'Tài khoản Google' : 'Email và mật khẩu' }}</h3><p>{{ $hasGoogle ? 'Tài khoản đã liên kết với Google.' : 'Đăng nhập bằng tên tài khoản hoặc email và mật khẩu.' }}</p></div><span class="profile-method-status">{{ $hasGoogle ? 'Đã liên kết' : 'Đã thiết lập' }}</span></div>
                            <div class="profile-password"><div><h3>Mật khẩu tài khoản</h3><p>{{ $hasGoogle ? 'Bạn có thể tiếp tục sử dụng Google để đăng nhập.' : 'Không chia sẻ mật khẩu của bạn với người khác.' }}</p></div><button type="button" disabled aria-describedby="profile-password-note">Đổi mật khẩu <i class="far fa-lock" aria-hidden="true"></i></button></div>
                            <p id="profile-password-note" class="profile-muted-note">Chức năng đổi mật khẩu chưa khả dụng.</p>
                        </div>
                    </section>
                    <p class="profile-bottom-note"><i class="far fa-user-circle" aria-hidden="true"></i> Đây là hồ sơ của tài khoản bạn đang đăng nhập.</p>
                </div>
            </div>
        @else
            <section class="profile-card profile-guest"><h2>Đăng nhập để xem hồ sơ</h2><p>Thông tin cá nhân chỉ hiển thị khi bạn đăng nhập tài khoản.</p><a class="profile-explore" href="{{ route('login') }}">Đăng nhập</a></section>
        @endif
    </div>
</main>

@include('clients.block.footer_2')
