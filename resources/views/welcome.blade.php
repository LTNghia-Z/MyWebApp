<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chào mừng đến với Chợ Thực Phẩm Tươi Ngon!</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts - Nunito (Consistent Font with Admin Panel) -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Custom Styles for Food Market Welcome Page - Modernized */

        body {
            font-family: 'Nunito', sans-serif; /* Using Nunito Font */
            color: #495057; /* Darker, softer text color */
            background-color: #f8f9fa; /* Light, modern background color */
        }

        /* Header */
        .header {
            padding: 1rem 0; /* Reduced padding */
            background-color: #fff; /* White header background */
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); /* Subtle shadow */
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            font-weight: 700; /* Bold logo text */
            color: #343a40; /* Darker logo text */
            font-size: 1.75rem; /* Larger logo text */
        }


        .navbar-brand img {
            height: 45px; /* Slightly larger logo image */
            margin-right: 15px;
        }

        /* Hero Section - More modern background and layout */
        .hero {
            background: linear-gradient(135deg, #e7f3ff 50%, #fff 50%); /* Soft gradient background */
            padding: 100px 0; /* Increased padding */
        }

        .hero-text {
            padding-right: 50px; /* More right padding for text */
        }

        .hero h1 {
            color: #212529; /* Darker, more prominent heading */
            font-weight: 700; /* Bold heading */
            font-size: 3.5rem; /* Larger display heading */
            margin-bottom: 1rem;
        }

        .hero p {
            color: #6c757d; /* Slightly lighter lead text */
            font-size: 1.25rem; /* Slightly larger lead text */
            line-height: 1.7;
        }

        .hero-image img {
            border-radius: 0.5rem; /* Slightly rounded corners */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); /* More pronounced shadow */
            max-width: 100%; /* Ensure image responsiveness */
            height: auto;
        }

        .btn-primary {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.1); /* Shadow for primary button */
            transition: transform 0.2s ease-in-out; /* Hover transition */
        }

        .btn-primary:hover {
            transform: translateY(-2px); /* Slight lift on hover */
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.15); /* Increased shadow on hover */
        }


        /* About Us Section - Cleaner icons and layout */
        .about-us {
            padding: 70px 0;
            background-color: #f8f9fa; /* Main background color */
        }

        .about-us h2 {
            color: #212529; /* Darker section heading */
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .about-us .lead {
            color: #6c757d; /* Light lead text */
            font-size: 1.1rem;
            text-align: center;
            margin-bottom: 3rem;
        }

        .about-us-item {
            text-align: center;
            padding: 20px;
            border-radius: 0.5rem;
            background-color: #fff; /* White boxes for about us items */
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); /* Subtle box shadow */
            transition: transform 0.2s ease-in-out;
        }

        .about-us-item:hover {
            transform: translateY(-5px); /* Lift on hover for about us boxes */
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.15); /* Increased shadow on hover */
        }


        .about-us i {
            opacity: 1; /* Icons are now fully opaque */
            color: #007bff; /* Primary color for icons */
            margin-bottom: 1rem;
        }

        .about-us h4 {
            color: #343a40; /* Darker feature heading */
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .about-us p {
            color: #6c757d; /* Light text for feature description */
        }


        /* Featured Categories Section - Enhanced cards */
        .featured-categories {
            padding: 70px 0;
             background-color: #fff; /* White background for categories */
        }

        .featured-categories h2 {
            color: #212529; /* Darker category section heading */
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        .featured-categories .card {
            border-radius: 0.5rem; /* Rounded corners for category cards */
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); /* Lighter shadow for category cards */
            overflow: hidden; /* Ensure rounded corners clip images */
            border: none; /* No border for cleaner look */
        }


        .featured-categories .card:hover {
            transform: translateY(-5px); /* Lift on hover for category cards */
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.15); /* Increased shadow on hover */
        }

        .featured-categories .card-img-top {
            height: 220px; /* Increased image height for category cards */
            object-fit: cover; /* Cover object fit */
            transition: transform 0.3s ease-in-out; /* Image hover zoom effect */
        }

        .featured-categories .card:hover .card-img-top {
            transform: scale(1.1); /* Zoom in effect on hover */
        }

        .featured-categories .card-body {
            padding: 1.5rem; /* Increased card body padding */
        }

        .featured-categories .card-title {
            font-weight: 600; /* Bold category title */
            color: #343a40; /* Darker category title color */
            margin-bottom: 0.75rem;
        }

        .featured-categories .card-text {
            color: #6c757d; /* Light text color for category description */
        }

        .featured-categories .btn-outline-primary {
            transition: transform 0.2s ease-in-out;
        }

        .featured-categories .btn-outline-primary:hover {
            transform: translateY(-2px);
        }


        /* Footer - Modern, light style */
        .footer {
            background-color: #fff; /* White footer background */
            color: #6c757d; /* Lighter footer text color */
            padding: 2.5rem 0;
            border-top: 1px solid #e0e0e0; /* Light top border for footer */
            text-align: center;
        }

        .footer a {
            color: #007bff; /* Primary color for footer links */
        }

        .footer a:hover {
            color: #0056b3; /* Darker primary color on hover */
            text-decoration: underline;
        }

        .footer p {
            font-size: 0.95rem;
        }


        /* Responsive adjustments for mobile and tablet */
        @media (max-width: 992px) {
            .hero {
                padding: 80px 0; /* Adjusted padding for tablet screens */
            }
            .hero-text {
                padding-right: 20px; /* Adjusted right padding for tablet screens */
            }
            .hero h1 {
                font-size: 3rem; /* Adjusted heading size for tablet screens */
            }
             .hero p {
                font-size: 1.1rem; /* Adjusted lead text size for tablet screens */
            }
        }


        @media (max-width: 768px) {
            .hero {
                padding: 60px 0; /* Further reduced padding for mobile */
                text-align: center; /* Center align hero text on mobile */
            }
            .hero-text {
                padding-right: 0; /* Removed right padding on mobile */
                margin-bottom: 30px; /* Added margin below text on mobile */
            }
            .hero h1 {
                font-size: 2.5rem; /* Adjusted heading size for mobile */
            }
            .hero p {
                font-size: 1rem; /* Adjusted lead text size for mobile */
            }
            .hero-image {
                text-align: center; /* Center align hero image on mobile */
            }

            .hero-image img {
                max-width: 90%; /* Make hero image responsive on mobile */
            }

            .about-us {
                padding: 50px 0; /* Adjusted padding for about us on mobile */
            }
             .featured-categories {
                padding: 50px 0; /* Adjusted padding for categories on mobile */
            }
        }
    </style>
</head>

<body>

    <!-- Header (Logo và Navigation - đơn giản) -->
    <header class="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="#">
                    <img src="https://i.ibb.co/Tx36RWFx/logo-removebg-preview.png" alt="logo">
                    <span class="ms-2">Chợ Thực Phẩm Tươi Ngon</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link btn btn-primary text-black ms-md-2 " href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i> Khám phá ngay
                        </a>
                      </li>
                    </ul>
                  </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 hero-text">
                    <h1 class="display-4 fw-bold">Thực Phẩm Tươi Ngon Cho Cuộc Sống Chất Lượng!</h1>
                    <p class="lead">Khám phá sự đa dạng của thực phẩm tươi ngon từ nông trại đến bàn ăn. Chọn lựa chất lượng, trải nghiệm hương vị đích thực mỗi ngày cùng Chợ Thực Phẩm Tươi Ngon.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-basket me-2"></i> Mua sắm ngay
                    </a>
                </div>
                <div class="col-md-6 hero-image">
                    <img src="{{ asset('images/back1.jpg') }}" alt="Hero Image Food Market" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Giới thiệu ngắn gọn -->
    <section id="ve-chung-toi" class="about-us py-5">
        <div class="container">
            <h2 class="text-center mb-4">Về Chợ Thực Phẩm Của Chúng Tôi</h2>
            <p class="lead text-center">Chợ Thực Phẩm Tươi Ngon mang đến sự khác biệt trong trải nghiệm mua sắm thực phẩm trực tuyến. Chúng tôi cam kết về chất lượng, sự tươi ngon và dịch vụ tận tâm, giúp bạn dễ dàng tiếp cận nguồn thực phẩm tốt nhất cho gia đình.</p>
            <div class="row mt-5 justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="about-us-item">
                        <i class="fas fa-seedling fa-3x text-success mb-3"></i>
                        <h4>Sản Phẩm Tươi Mới</h4>
                        <p>Chọn lọc kỹ lưỡng từ các nhà cung cấp uy tín, đảm bảo thực phẩm luôn tươi mới, giàu dinh dưỡng.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="about-us-item">
                        <i class="fas fa-truck fa-3x text-info mb-3"></i>
                        <h4>Giao Hàng Tiện Lợi</h4>
                        <p>Hệ thống giao hàng nhanh chóng, chuyên nghiệp, giữ trọn vẹn sự tươi ngon đến tận tay bạn.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="about-us-item">
                        <i class="fas fa-hand-holding-heart fa-3x text-warning mb-3"></i>
                        <h4>Uy Tín & Tận Tâm</h4>
                        <p>Đặt uy tín và sự hài lòng của khách hàng lên hàng đầu, luôn sẵn sàng hỗ trợ và lắng nghe.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Danh mục nổi bật (tùy chọn) -->
    <section id="danh-muc" class="featured-categories py-5">
        <div class="container">
            <h2 class="text-center mb-5">Khám Phá Danh Mục Sản Phẩm Nổi Bật</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('images/healthy-vegetables-wooden-table.jpg') }}" class="card-img-top" alt="Rau củ">
                        <div class="card-body">
                            <h5 class="card-title">Rau Củ Quả Tươi Ngon</h5>
                            <p class="card-text">Đa dạng rau xanh, củ quả theo mùa, tươi mới mỗi ngày, giàu vitamin và khoáng chất.</p>
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Xem Ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('images/colorful-fruit.jpg') }}" class="card-img-top" alt="Trái cây">
                        <div class="card-body">
                            <h5 class="card-title">Trái Cây Tươi Mọng Nước</h5>
                            <p class="card-text">Trái cây theo mùa và nhập khẩu, chất lượng cao, đảm bảo vị ngọt tự nhiên và tươi ngon.</p>
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Xem Ngay</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset('images/mixed-sashimi.jpg') }}" class="card-img-top" alt="Thịt tươi">
                        <div class="card-body">
                            <h5 class="card-title">Thịt & Hải Sản Cao Cấp</h5>
                            <p class="card-text">Thịt tươi sống, hải sản được chọn lọc kỹ càng, nguồn gốc rõ ràng, tươi ngon mỗi ngày.</p>
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Xem Ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS (nếu cần) -->
    <script src="js/script.js"></script>
</body>

</html>