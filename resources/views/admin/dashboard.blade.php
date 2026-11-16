<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản trị | Vivutravel</title>

    <link rel="stylesheet"
          href="{{ asset('clients/assets/css/bootstrap.min.css') }}">
</head>

<body class="bg-light">
    <main class="container py-5">
        <section class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <h1 class="h4">Quản trị Vivutravel</h1>

                        <p class="mb-0">
                            Xin chào,
                            <strong>
                                {{ Auth::guard('admin')->user()->userName }}
                            </strong>
                        </p>
                    </div>

                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf

                        <button type="submit" class="btn btn-outline-danger">
                            Đăng xuất
                        </button>
                    </form>
                </div>

                <hr>

                <p class="mb-0">Bạn đã đăng nhập quản trị thành công.</p>
            </div>
        </section>
    </main>
</body>
</html>