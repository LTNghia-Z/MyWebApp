<div class="mb-3">@extends('user.layouts')

    @section('content')
    <div class="container">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa thông tin tài khoản</h1>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Edit Profile Card -->
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-user-edit me-2"></i> Chỉnh sửa thông tin cá nhân</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <form action="{{ route('user.update', $account->id) }}" method="PUT">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="username" class="form-label"><i class="fas fa-user me-1"></i> Tên người dùng <span class="text-danger">*</span></label>
                        <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username', $account->username) }}" placeholder="Nhập tên người dùng" required>
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label"><i class="fas fa-envelope me-1"></i> Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $account->email) }}" placeholder="Nhập địa chỉ email" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label"><i class="fas fa-phone-alt me-1"></i> Số điện thoại <span class="text-danger">*</span></label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone', $account->phone) }}" placeholder="Nhập số điện thoại" required>
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Phần nhập địa chỉ -->
                    <div class="mb-3">
                        <label for="address" class="form-label"><i class="fas fa-map-marker-alt me-1"></i> Địa chỉ</label>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <select id="province-select" name="province_code" class="form-select">
                                    <option value="">-- Chọn Tỉnh/Thành phố --</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select id="district-select" name="district_code" class="form-select" disabled>
                                    <option value="">-- Chọn Quận/Huyện --</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select id="ward-select" name="ward_code" class="form-select" disabled>
                                    <option value="">-- Chọn Phường/Xã --</option>
                                </select>
                            </div>
                        </div>
                        @error('address')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input ẩn lưu JSON địa chỉ -->
                    <input type="hidden" id="address-json" name="address" value="{{ old('address', $account->address) }}">

                    <div class="mt-4">
                        <button type="submit" class="btn btn-warning shadow-sm">
                            <i class="fas fa-save fa-sm text-white-50 me-1"></i> Cập nhật tài khoản
                        </button>
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">
                            <i class="fas fa-ban fa-sm text-white-50 me-1"></i> Quay lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        window.oldAddress = <?php echo json_encode($account->address, true); ?>;
    </script>
    <script src="{{asset('js/address.js')}}"></script>