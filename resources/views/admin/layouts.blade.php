<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Chợ Thực Phẩm</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Google Fonts - Nunito (chọn font chữ hiện đại hơn) -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <style>
        /* Áp dụng font chữ Nunito và màu sắc mới */
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f6f9; /* Màu nền nhạt, hiện đại */
            color: #343a40; /* Màu chữ tối hơn cho dễ đọc */
        }

        /* Navbar: đổi màu, thêm bóng đổ và làm nổi bật hơn */
        .navbar {
            background: #fff; /* Navbar màu trắng */
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); /* Bóng đổ nhẹ */
            border-bottom: 1px solid #e0e0e0; /* Đường viền dưới nhẹ */
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            color: #fff; /* Màu chữ brand đậm hơn */
            font-weight: bold; /* In đậm tên brand */
        }

        .navbar-brand img {
            height: 40px;
            width: auto;
            margin-right: 10px;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #6c757d; /* Màu chữ menu link khi không active */
        }

        .navbar-dark .navbar-nav .nav-link:hover,
        .navbar-dark .navbar-nav .nav-link:focus {
            color: #495057; /* Màu chữ link khi hover */
        }

        .navbar-dark .navbar-nav .nav-link.active {
            color: #007bff !important; /* Màu active link - màu chủ đạo, ví dụ xanh dương */
            font-weight: bold; /* Active link đậm hơn */
            border-bottom: 2px solid #007bff; /* Gạch chân khi active */
        }

        .container {
            margin-top: 30px; /* Tăng khoảng cách container so với navbar */
        }

        /* Side menu (nếu cần phát triển thêm, ví dụ responsive sidebar) */
        /* Hiện tại các link menu đang ở navbar, bạn có thể chuyển xuống sidebar nếu muốn */

        /* Alert notification (thông báo) */
        .alert-info {
            background-color: #e7f3ff; /* Màu nền nhạt cho alert info */
            border-color: #cce5ff;
            color: #0056b3;
            border-radius: 0.25rem; /* Bo góc nhẹ */
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); /* Bóng đổ nhẹ */
        }

        .alert-info .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }

        .alert-info .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Các class tùy chỉnh khác nếu bạn có */
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!-- Đổi class navbar thành navbar-light bg-light để sử dụng navbar màu trắng,
             và điều chỉnh class trong style -->
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-chart-line me-2"></i> Admin Panel <!-- Thêm icon cho brand -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.food.*') ? 'active' : '' }}" href="{{ route('admin.food.index') }}">
                            <i class="fas fa-utensils me-1"></i> Food <!-- Thêm icon cho menu item -->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.order.*') ? 'active' : '' }}" href="{{ route('admin.order.index') }}">
                            <i class="fas fa-shopping-cart me-1"></i> Orders <!-- Thêm icon cho menu item -->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}" href="{{ route('admin.customer.index') }}">
                            <i class="fas fa-users me-1"></i> Customers <!-- Đổi 'Customer' thành 'Customers' và thêm icon -->
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.logout') }}">
                            <i class="fas fa-sign-out-alt"></i> Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container chính -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Alert thông báo đơn hàng mới -->
    @if(session()->has('admin_new_orders'))
    <div class="alert alert-info alert-dismissible fade show position-fixed top-0 end-0 m-3"
        style="z-index: 1050; width: 300px;" role="alert">
        <i class="fas fa-bell me-2"></i> <strong>Thông báo:</strong> Có {{ count(session('admin_new_orders')) }} đơn hàng mới!
        <ul class="mt-2">
            @foreach(session('admin_new_orders') as $order)
            <li>🛒 Mã đơn: {{ $order['id'] }} - {{ number_format($order['total_price']) }} VNĐ</li>
            @endforeach
        </ul>
        <button type="button" class="btn btn-sm btn-primary" id="mark-as-seen">Đánh dấu đã đọc</button>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> <!-- Thêm nút close cho alert -->
    </div>
    @endif

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/admin.js') }}"></script>

</body>

</html>