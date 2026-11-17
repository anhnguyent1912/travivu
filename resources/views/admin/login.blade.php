@include('admin.block.header', ['title' => 'Đăng nhập quản trị'])
<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <section class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h4 mb-2">Quản trị Vivutravel</h1>
                    <p class="text-muted mb-4">
                        Đăng nhập để quản lý website.
                    </p>
                    <form method="POST" action="{{ route('admin.login.submit') }}" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="admin-username" class="form-label">
                                Tên đăng nhập
                            </label>
                            <input type="text" id="admin-username" name="username" class="form-control"
                                value="{{ old('username') }}" autocomplete="username" required>

                            @error('username')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="admin-password" class="form-label">
                                Mật khẩu
                            </label>

                            <input type="password" id="admin-password" name="password" class="form-control"
                                autocomplete="current-password" required>

                            @error('password')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success w-100">
                            Đăng nhập
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</main>
@include('admin.block.footer')
