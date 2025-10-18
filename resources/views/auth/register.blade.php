<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Đăng ký') }} - Chợ Thực Phẩm</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Google Fonts - Nunito (Consistent Font) -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        /* Modern Register Page Styles - Consistent with Login */
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f6f9;
            color: #343a40;
            display: flex;
            align-items: center;
            min-height: 100vh;
        }

        .register-container {
            width: 100%;
            max-width: 500px; /* Slightly wider for Register form */
            padding: 1.5rem;
            margin: auto;
        }

        .card-register {
            border: 0;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .card-header-register {
            background-color: #fff;
            border-bottom: 1px solid #e0e0e0;
            padding: 1.5rem;
            text-align: center;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .card-body-register {
            padding: 1.5rem;
        }

        .logo-register {
            width: 80px;
            height: 60px;
            margin-bottom: 1rem;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .form-label-register {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #495057;
        }

        .form-control-register {
            border-radius: 0.3rem;
            padding: 0.8rem 1rem;
            font-size: 1rem;
        }

        .form-control-register:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary-register {
            width: 100%;
            padding: 0.8rem 1.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 0.3rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .btn-primary-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.15);
        }

        .link-login {
            display: block;
            margin-top: 1rem;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }

        .link-login:hover {
            text-decoration: underline;
            color: #0056b3;
        }

        .invalid-feedback {
            text-align: left;
        }
    </style>
</head>

<body class="text-center">

    <main class="register-container">
        <div class="card card-register">
            <div class="card-header card-header-register">
                <img class="logo-register mb-2" src="https://i.ibb.co/Tx36RWFx/logo-removebg-preview.png" alt="Logo Chợ Thực Phẩm">
                <h1 class="h4 mb-0 font-weight-normal">{{ __('Đăng ký tài khoản') }}</h1>
            </div>
            <div class="card-body card-body-register">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control form-control-register @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" placeholder="Tên đăng nhập" required autofocus>
                        <label for="username" class="form-label-register"><i class="fas fa-user me-1"></i> {{ __('Tên đăng nhập') }} <span class="text-danger">*</span></label>
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control form-control-register @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Địa chỉ Email" required>
                        <label for="email" class="form-label-register"><i class="fas fa-envelope me-1"></i> {{ __('Địa chỉ Email') }} <span class="text-danger">*</span></label>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control form-control-register @error('password') is-invalid @enderror" id="password" name="password" placeholder="Mật khẩu" required autocomplete="new-password">
                        <label for="password" class="form-label-register"><i class="fas fa-lock me-1"></i> {{ __('Mật khẩu') }} <span class="text-danger">*</span></label>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control form-control-register" id="password-confirm" name="password_confirmation" placeholder="Xác nhận mật khẩu" required autocomplete="new-password">
                        <label for="password-confirm" class="form-label-register"><i class="fas fa-lock me-1"></i> {{ __('Xác nhận mật khẩu') }} <span class="text-danger">*</span></label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control form-control-register @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Số điện thoại" required>
                        <label for="phone" class="form-label-register"><i class="fas fa-phone-alt me-1"></i> {{ __('Số điện thoại') }} <span class="text-danger">*</span></label>
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <button class="btn btn-primary btn-primary-register" type="submit"><i class="fas fa-user-plus me-1"></i> {{ __('Đăng ký') }}</button>

                    <a class="link-login" href="{{ route('login') }}">
                        {{ __('Bạn đã có tài khoản? Đăng nhập') }}
                    </a>
                </form>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS (nếu bạn có file JS riêng) -->
    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>