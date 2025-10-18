@extends('admin.layouts')

@section('title', 'Thêm Khách hàng mới')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm Khách hàng mới</h1>
    </div>

    <!-- Breadcrumb -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}">Khách hàng</a></li>
        <li class="breadcrumb-item active">Thêm mới</li>
    </ol>

    <!-- Create Customer Card -->
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-plus me-2"></i> Nhập thông tin Khách hàng mới</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('admin.customer.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label"><i class="fas fa-user me-1"></i> Tên Khách hàng <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" placeholder="Nhập tên khách hàng" required>
                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label"><i class="fas fa-envelope me-1"></i> Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Nhập địa chỉ email" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label"><i class="fas fa-phone-alt me-1"></i> Số điện thoại <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Nhập số điện thoại" required>
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label"><i class="fas fa-map-marker-alt me-1"></i> Địa chỉ</label>
                    <div class="row g-2">
                        <!-- Select Tỉnh/Thành phố -->
                        <div class="col-md-4">
                            <select id="province-select" name="province_code" class="form-select">
                                <option value="">-- Chọn Tỉnh/Thành phố --</option>
                            </select>
                        </div>

                        <!-- Select Quận/Huyện -->
                        <div class="col-md-4">
                            <select id="district-select" name="district_code" class="form-select" disabled>
                                <option value="">-- Chọn Quận/Huyện --</option>
                            </select>
                        </div>

                        <!-- Select Phường/Xã -->
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

                <input type="hidden" id="address-json" name="address">

                <div class="mt-4">
                    <button type="submit" class="btn btn-success shadow-sm">
                        <i class="fas fa-save fa-sm text-white-50 me-1"></i> Lưu Khách hàng
                    </button>
                    <a href="{{ route('admin.customer.index') }}" class="btn btn-secondary">
                        <i class="fas fa-ban fa-sm text-white-50 me-1"></i> Hủy bỏ
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('js/address.js')}}"></script>

@endsection