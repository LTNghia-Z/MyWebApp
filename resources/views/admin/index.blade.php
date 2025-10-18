<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Đăng nhập - Chợ Thực Phẩm</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts - Nunito (Consistent Font) -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Modern Admin Login Page Styles - Consistent with User Login */
        html,
        body {
            height: 100%;
            font-family: 'Nunito', sans-serif; /* Consistent Nunito font */
            background-color: #f4f6f9; /* Light modern background */
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            color: #343a40; /* Dark grey text for readability */
        }

        .admin-login-container {
            width: 100%;
            max-width: 400px; /* Adjusted max-width for admin login form */
            padding: 1.5rem;
            margin: auto;
        }

        .card-admin-login {
            border: 0;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1); /* Soft shadow for the card */
        }

        .card-header-admin-login {
            background-color: #fff; /* White card header */
            border-bottom: 1px solid #e0e0e0; /* Light header border */
            padding: 1.5rem;
            text-align: center;
            border-radius: 0.5rem 0.5rem 0 0; /* Rounded top corners */
        }

        .card-body-admin-login {
            padding: 1.5rem;
        }

        .logo-admin-login {
            width: 80px;
            height: 60px;
            margin-bottom: 1rem;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .form-label-admin-login {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #495057; /* Darker label text */
        }

        .form-control-admin-login {
            border-radius: 0.3rem;
            padding: 0.8rem 1rem;
            font-size: 1rem;
        }

        .form-control-admin-login:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary-admin-login {
            width: 100%;
            padding: 0.8rem 1.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 0.3rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .btn-primary-admin-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.15);
        }

        .alert-danger {
            border-radius: 0.3rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body class="text-center">

    <main class="admin-login-container">
        <div class="card card-admin-login">
            <div class="card-header card-header-admin-login">
                <img class="logo-admin-login mb-2" src="https://i.ibb.co/Tx36RWFx/logo-removebg-preview.png" alt="Logo">
                <h1 class="h3 mb-3 fw-normal">Admin Đăng nhập</h1>
            </div>
            <div class="card-body card-body-admin-login">
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control form-control-admin-login" id="username" name="username" placeholder="Tên đăng nhập" required autofocus>
                            <label for="username" class="form-label-admin-login"><i class="fas fa-user me-1"></i> Tên đăng nhập</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="password" class="form-control form-control-admin-login" id="password" name="password" placeholder="Mật khẩu" required>
                            <label for="password" class="form-label-admin-login"><i class="fas fa-lock me-1"></i> Mật khẩu</label>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-1"></i> {{ $errors->first('login') }}
                        </div>
                    @endif

                    <button class="w-100 btn btn-lg btn-primary btn-primary-admin-login" type="submit"><i class="fas fa-sign-in-alt me-1"></i> Đăng nhập</button>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>