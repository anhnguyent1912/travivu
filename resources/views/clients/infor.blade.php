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
            <a class="profile-explore" href="{{ route('Tour') }}">Khám phá tour <i class="fal fa-arrow-up-right"
                    aria-hidden="true"></i><span aria-hidden="true">↗</span></a>
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
                                <p>Thông tin hiện tại của bạn trên Web.</p>
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
                                        value="{{ old('fullname', $profile->fullname) }}" placeholder="Nhập học và tên"
                                        maxlength="70" name="fullname">
                                    @error('fullname')
                                        <small class="alert alert-danger">{{ $message }}</small>
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
                                        placeholder="Nhập số điện thoại" maxlength="10"name="phoneNumber">
                                    @error('phoneNumber')
                                        <small class="alert alert-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="profile-field"><label for="profile-address">Địa chỉ</label><input
                                        id="profile-address" type="text"
                                        value="{{ old('address', $profile->address) }}" placeholder="Nhập địa chỉ"
                                        maxlength="255" name="address">
                                    @error('address')
                                        <small class="alert alert-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="profile-explore">
                                    Lưu thay đổi
                                </button>
                            </div>
                        </form>
                    </section>

                    <section id="profile-security" class="profile-card">
                        <div class="profile-card-body">
                            @if (session('login_method') === 'password')
                                @if (session('password_success'))
                                    <div class="alert alert-success" role="status">
                                        {{ session('password_success') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('user-profile.password') }}"novalidate>
                                    @csrf
                                    @method('PATCH')
                                    <div class="profile-field">
                                        <label for="current-password">Mật khẩu hiện tại</label>
                                        <input id="current-password" name="current_password" type="password"
                                            autocomplete="current-password" required>
                                        @error('current_password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="profile-field mt-2">
                                        <label for="new-password">Mật khẩu mới</label>
                                        <input id="new-password" name="password" type="password"
                                            autocomplete="new-password" minlength="8" required>

                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="profile-field mt-2">
                                        <label for="confirm-password">Xác nhận mật khẩu mới</label>
                                        <input id="confirm-password" name="password_confirmation" type="password"
                                            autocomplete="new-password" required>
                                        @error('password_confirmation')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <button type="submit" class="profile-explore mt-3">Đổi mật khẩu</button>
                                </form>
                            @elseif (session('login_method') === 'google')
                                <p>Bạn đang đăng nhập bằng tài khoản Google.Không thể đổi mật khẩu.</p>
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
                <p>Thông tin cá nhân chỉ hiển thị khi bạn đăng nhập tài khoản.</p><a class="profile-explore"
                    href="{{ route('login') }}">Đăng nhập</a>
            </section>
        @endif
    </div>
</main>

@include('clients.block.footer')
