<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- Google Fonts - Nunito (Consistent Font with Admin Panel) -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

  <title>{{ config('app.name', 'Food Market') }}</title>

  <style>
    /* Apply Nunito font to body */
    body {
      font-family: 'Nunito', sans-serif;
      background-color: #f8f9fa; /* Light grey background */
      color: #343a40; /* Dark grey text for readability */
    }

    /* Navbar Customization */
    .navbar {
      background-color: #fff; /* White navbar background */
      box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); /* Light shadow for depth */
    }

    .navbar-brand {
      font-weight: 700; /* Bold brand name */
      font-size: 1.5rem; /* Slightly larger brand size */
      color: #212529; /* Dark text color for brand */
      transition: color 0.3s ease; /* Smooth color transition */
    }

    .navbar-brand:hover {
      color: #007bff; /* Primary color on hover */
    }

    .navbar-nav .nav-link {
      color: #495057; /* Muted grey color for nav links */
      margin: 0 0.75rem; /* Adjusted link spacing */
      transition: color 0.3s ease;
      padding: 0.7rem 1rem; /* Slightly larger padding for links */
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
      color: #007bff; /* Primary color on hover and active */
    }

    .navbar-nav .nav-item.active .nav-link {
        font-weight: 600; /* Make active link slightly bolder */
    }


    .navbar-toggler {
      border-color: rgba(0, 0, 0, 0.1); /* Light border for toggler */
    }

    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='rgba(0, 0, 0, 0.5)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }


    /* User Avatar */
    .user-avatar {
      width: 35px; /* Slightly larger avatar */
      height: 35px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 8px; /* Increased margin */
      border: 2px solid #e0e0e0; /* Light grey border */
      box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); /* Subtle shadow */
    }

    /* Dropdown Menu */
    .dropdown-menu {
      border: 1px solid rgba(0,0,0,.1); /* Light border for dropdown menu */
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); /* More prominent dropdown shadow */
    }

    .dropdown-item {
      color: #495057; /* Darker text for dropdown items */
    }

    .dropdown-item:hover, .dropdown-item:focus, .dropdown-item.active {
      background-color: #e9ecef; /* Light grey background on hover/active dropdown item */
      color: #212529; /* Darker text on hover/active dropdown item */
    }


    /* Main Content Area */
    main {
      padding-top: 2rem;
      padding-bottom: 2rem;
    }

    .py-4 { /* Keep py-4 for default content area, adjust if needed */
        padding-top: 1.5rem !important;
        padding-bottom: 1.5rem !important;
    }


    /* Footer */
    footer {
      background-color: #f8f9fa; /* Light grey footer background - same as body */
      border-top: 1px solid #e0e0e0; /* Light top border for footer */
      color: #6c757d; /* Light text color for footer */
    }

    footer p {
        font-size: 0.9rem;
    }


    /* Responsive Adjustments (Minimal needed as Bootstrap handles well) */
    @media (max-width: 576px) {
      .navbar-brand {
        font-size: 1.3rem; /* Adjust brand size on small screens */
      }
      .navbar-nav .nav-link {
        margin: 0 0.3rem; /* Reduce link margin on small screens */
        padding: 0.5rem 0.7rem; /* Reduce link padding on small screens */
      }
      .user-avatar {
        width: 30px; /* Adjust avatar size on small screens if needed */
        height: 30px;
        margin-right: 5px;
      }
    }
  </style>
</head>
<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <!-- Brand Logo/Name -->
        <a class="navbar-brand" href="#">
          Food Market
        </a>

        <!-- Responsive Navbar Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left-aligned Links (Optional) -->

          <!-- Right-aligned Items -->
          <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('user.order') }}">
                <i class="fas fa-shopping-cart me-1"></i> Giỏ hàng
                <!-- Cart Quantity Badge -->
                @php
                    $cart = session('cart');
                    $cartQuantity = 0;
                    if ($cart) {
                        foreach ($cart as $item) {
                            $cartQuantity += $item['quantity'];
                        }
                    }
                @endphp
                @if($cartQuantity > 0)
                    <span class="ms-1 badge bg-primary text-white rounded-pill">{{ $cartQuantity }}</span>
                @endif
              </a>

            </li>

            <!-- User Dropdown -->
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                 data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                Người dùng
              </a>

              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('user.profile') }}">
                  <i class="fas fa-user-cog me-2"></i> Tài khoản
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}">
                  <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
      @yield('content')
    </main>
  </div>

  <!-- Bootstrap and FontAwesome JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>