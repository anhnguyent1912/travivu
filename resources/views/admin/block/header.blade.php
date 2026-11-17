<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Quản trị' }} | Vivutravel</title>

    <link rel="stylesheet" href="{{ asset('clients/assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">
</head>

<body>
    <div class="admin-layout">
        @auth('admin')
            @include('admin.block.sidebar')
        @endauth

        <div class="admin-content">
            <header class="admin-topbar d-flex flex-wrap justify-content-between align-items-center gap-3">
                <strong>{{ $title ?? 'Quản trị Vivutravel' }}</strong>

                @auth('admin')
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf

                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            Đăng xuất
                        </button>
                    </form>
                @endauth
            </header>
