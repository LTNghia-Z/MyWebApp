<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Đăng nhập') }} - Chợ Thực Phẩm</title> {{-- Tiêu đề trang --}}

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Google Fonts - Nunito (Consistent Font with Admin Panel) -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        /* Modern Login Page Styles */
        body {
            font-family: 'Nunito', sans-serif; /* Consistent Nunito font */
            background-color: #f4f6f9; /* Light, modern background */
            color: #343a40; /* Dark grey text for better readability */
            display: flex;
            align-items: center;
            min-height: 100vh; /* Ensure body takes full viewport height */
        }

        .login-container {
            width: 100%;
            max-width: 450px; /* Slightly wider form */
            padding: 1.5rem;
            margin: auto;
        }

        .card-login {
            border: 0; /* Remove card border for a cleaner look */
            border-radius: 0.5rem; /* Rounded corners for the card */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); /* Soft, modern shadow */
        }

        .card-header-login {
            background-color: #fff; /* White card header */
            border-bottom: 1px solid #e0e0e0; /* Light header border */
            padding: 1.5rem;
            text-align: center;
            border-radius: 0.5rem 0.5rem 0 0; /* Rounded top corners */
        }

        .card-body-login {
            padding: 1.5rem;
        }

        .logo-login {
            width: 80px; /* Slightly larger logo */
            height: 60px;
            margin-bottom: 1rem;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .form-label-login {
            font-weight: 600; /* Semi-bold labels */
            margin-bottom: 0.5rem;
            color: #495057; /* Darker label text */
        }

        .form-control-login {
            border-radius: 0.3rem; /* Slightly rounded form controls */
            padding: 0.8rem 1rem; /* Adjusted padding for input fields */
            font-size: 1rem;
        }

        .form-control-login:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Standard Bootstrap focus shadow */
        }

        .btn-primary-login {
            width: 100%; /* Full width button */
            padding: 0.8rem 1.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 0.3rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.1); /* Button shadow */
            transition: transform 0.2s ease-in-out;
        }

        .btn-primary-login:hover {
            transform: translateY(-2px); /* Button lift on hover */
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.15); /* Increased shadow on hover */
        }

        .link-register {
            display: block;
            margin-top: 1rem;
            text-align: center;
            color: #007bff; /* Primary color for register link */
            text-decoration: none;
        }

        .link-register:hover {
            text-decoration: underline; /* Underline on hover */
            color: #0056b3; /* Darker primary color on hover */
        }

        .invalid-feedback {
            text-align: left; /* Align invalid feedback to the left */
        }
    </style>
</head>

<body class="text-center">
<div class="alert-container" style="position: absolute; top: 1rem; right: 50%; transform: translateX(50%); z-index: 9999;">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

    <main class="login-container">
        <div class="card card-login">
            <div class="card-header card-header-login">
                <img class="logo-login mb-2" src="https://i.ibb.co/Tx36RWFx/logo-removebg-preview.png" alt="Logo Chợ Thực Phẩm">
                <h1 class="h4 mb-0 font-weight-normal">{{ __('Đăng nhập') }}</h1>
            </div>
            <div class="card-body card-body-login">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control form-control-login @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Địa chỉ Email" required autocomplete="email" autofocus>
                        <label for="email" class="form-label-login"><i class="fas fa-envelope me-1"></i> {{ __('Địa chỉ Email') }}</label>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control form-control-login @error('password') is-invalid @enderror" id="password" name="password" placeholder="Mật khẩu" required autocomplete="current-password">
                        <label for="password" class="form-label-login"><i class="fas fa-lock me-1"></i> {{ __('Mật khẩu') }}</label>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3 form-check text-start">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">{{ __('Ghi nhớ đăng nhập') }}</label>
                    </div>

                    <button class="btn btn-primary btn-primary-login" type="submit"><i class="fas fa-sign-in-alt me-1"></i> {{ __('Đăng nhập') }}</button>

                    <a class="link-register" href="{{ route('register') }}">
                        {{ __('Bạn chưa có tài khoản? Đăng ký ngay') }}
                    </a>
                </form>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS (nếu bạn có file JS riêng) -->
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        let alerts = document.querySelectorAll(".alert");
        alerts.forEach(function (alert) {
            setTimeout(function () {
                alert.classList.add("fade");
                setTimeout(() => alert.remove(), 500);
            }, 4000); // Ẩn sau 4 giây
        });
    });
</script>

</body>

</html>