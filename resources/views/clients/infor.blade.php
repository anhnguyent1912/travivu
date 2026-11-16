@include('clients.block.header_2')

@php
    $profile = auth()->user();
    $displayName = $profile?->fullname ?: ($profile?->username ?: 'Tài khoản của bạn');
    $initial = mb_strtoupper(mb_substr(trim($displayName), 0, 1));
    $isActive = $profile?->isActive === 'Y';
@endphp

<main class="profile-page">
    <div class="profile-shell">
        <div class="profile-heading">
            <div>
                <h1>Thông tin cá nhân</h1>
                <p>Cập nhật thông tin cá nhân và quản lý bảo mật tài khoản.</p>
            </div>
            <a class="theme-btn style-three" href="{{ route('Tour') }}">
                <span data-hover="Khám phá tour">Khám phá tour</span>
                <i class="fal fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>

        @if ($profile)
            <div class="profile-layout">
                <aside class="profile-sidebar" aria-label="Tóm tắt tài khoản">
                    <section class="profile-card profile-identity">
                        <div class="profile-cover" aria-hidden="true"><span>VIVUTRAVEL</span></div>
                        <div class="profile-identity-content">
                            <div class="profile-avatar" aria-hidden="true">{{ $initial }}</div>
                            <h2>{{ $displayName }}</h2>
                            <p class="profile-email">{{ $profile->email }}</p>
                            <span class="profile-badge {{ $isActive ? '' : 'profile-badge-pending' }}">
                                <i class="fas {{ $isActive ? 'fa-check-circle' : 'fa-clock' }}" aria-hidden="true"></i>
                                {{ $isActive ? 'Đã kích hoạt' : 'Chờ kích hoạt' }}
                            </span>
                            <div class="profile-account-id"><span>ID</span><strong>#{{ $profile->userid }}</strong>
                            </div>
                        </div>
                        <nav class="profile-nav" aria-label="Các mục hồ sơ">
                            <a href="#profile-details"><i class="far fa-user" aria-hidden="true"></i> Thông tin tài
                                khoản <span aria-hidden="true">↗</span></a>
                            <a href="#profile-security"><i class="far fa-shield-check" aria-hidden="true"></i> Đăng nhập
                                & bảo mật <span aria-hidden="true">↗</span></a>
                        </nav>
                    </section>
                    <div class="profile-tip"><i class="far fa-compass" aria-hidden="true"></i>
                        <div>
                            <strong>Hành trình mới đang chờ bạn</strong>
                            <p>Tìm một điểm đến yêu thích và lên kế hoạch cho chuyến đi tiếp theo.</p><a
                                href="{{ route('Tour') }}">Xem các tour du lịch <span aria-hidden="true">→</span></a>
                        </div>
                    </div>
                </aside>

                <div class="profile-content">
                    <section id="profile-details" class="profile-card">
                        <div class="profile-card-heading"><span class="profile-section-icon"><i class="far fa-id-card"
                                    aria-hidden="true"></i></span>
                            <div>
                                <h2>Thông tin tài khoản</h2>
                                <p>Tên đăng nhập và email chỉ dùng để xem.</p>
                            </div>
                        </div>
                        <form class="profile-card-body" method="POST" action="{{ route('user-profile.update') }}">
                            @csrf
                            @method('PATCH')

                            @if (session('success'))
                                <div class ="alert alert-success" role="status">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="profile-fields">
                                <div class="profile-field"><label for="profile-fullname">Họ và tên</label>
                                    <input id="profile-fullname" type="text"
                                        value="{{ old('fullname', $profile->fullname) }}" placeholder="Nhập họ và tên"
                                        maxlength="70" name="fullname">
                                    @error('fullname')
                                        <small class="text-danger" role="alert">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="profile-field"><label for="profile-username">Tên đăng nhập</label><input
                                        id="profile-username" type="text" value="{{ $profile->username }}" readonly>
                                </div>
                                <div class="profile-field profile-field-wide"><label for="profile-email">Địa chỉ
                                        email</label><input id="profile-email" type="email"
                                        value="{{ $profile->email }}" readonly><small>Email được sử dụng cho tài khoản
                                        của bạn.</small></div>
                                <div class="profile-field"><label for="profile-phone">Số điện thoại</label>
                                    <input id="profile-phone" type="tel"
                                        value="{{ old('phoneNumber', $profile->phoneNumber) }}"
                                        placeholder="Nhập số điện thoại" maxlength="10" name="phoneNumber">
                                    @error('phoneNumber')
                                        <small class="text-danger" role="alert">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="profile-field"><label for="profile-address">Địa chỉ</label><input
                                        id="profile-address" type="text"
                                        value="{{ old('address', $profile->address) }}" placeholder="Nhập địa chỉ"
                                        maxlength="255" name="address">
                                    @error('address')
                                        <small class="text-danger" role="alert">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="theme-btn">
                                    <span data-hover="Lưu thay đổi">Lưu thay đổi</span>
                                    <i class="fal fa-arrow-right" aria-hidden="true"></i>
                                </button>
                            </div>
                        </form>
                    </section>

                    <section id="profile-security" class="profile-card">
                        <div class="profile-card-heading">
                            <span class="profile-section-icon"><i class="far fa-lock" aria-hidden="true"></i></span>
                            <div>
                                <h2>Đổi mật khẩu</h2>
                                <p>Quản lý mật khẩu đăng nhập của bạn.</p>
                            </div>
                        </div>
                        <div class="profile-card-body">
                            @if (session('login_method') === 'password')
                                @if (session('password_success'))
                                    <div class="alert alert-success" role="status">
                                        {{ session('password_success') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('user-profile.password') }}" novalidate>
                                    @csrf
                                    @method('PATCH')
                                    <div class="profile-field">
                                        <label for="current-password">Mật khẩu hiện tại</label>
                                        <input id="current-password" name="current_password" type="password"
                                            autocomplete="current-password" required>
                                        @error('current_password')
                                            <small class="text-danger" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="profile-field mt-2">
                                        <label for="new-password">Mật khẩu mới</label>
                                        <input id="new-password" name="password" type="password"
                                            autocomplete="new-password" minlength="8" required>

                                        @error('password')
                                            <small class="text-danger" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="profile-field mt-2">
                                        <label for="confirm-password">Xác nhận mật khẩu mới</label>
                                        <input id="confirm-password" name="password_confirmation" type="password"
                                            autocomplete="new-password" required>
                                        @error('password_confirmation')
                                            <small class="text-danger" role="alert">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <button type="submit" class="theme-btn mt-3">
                                        <span data-hover="Đổi mật khẩu">Đổi mật khẩu</span>
                                        <i class="fal fa-arrow-right" aria-hidden="true"></i>
                                    </button>
                                </form>
                            @elseif (session('login_method') === 'google')
                                <p class="mb-0">Bạn đang đăng nhập bằng Google nên không thể đổi mật khẩu tại đây.</p>
                            @else
                                <p>Vui lòng đăng nhập để thay đổi mật khẩu.</p>
                            @endif
                        </div>
                    </section>
                    <p class="profile-bottom-note"><i class="far fa-user-circle" aria-hidden="true"></i> Đây là hồ sơ
                        của tài khoản bạn đang đăng nhập.</p>
                </div>
            </div>
        @else
            <section class="profile-card profile-guest">
                <h2>Đăng nhập để xem hồ sơ</h2>
                <p>Thông tin cá nhân chỉ hiển thị khi bạn đăng nhập tài khoản.</p><a class="theme-btn"
                    href="{{ route('login') }}">Đăng nhập</a>
            </section>
        @endif
    </div>
</main>

@include('clients.block.footer')
