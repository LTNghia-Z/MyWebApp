@extends('admin.layouts')

@section('title', 'Thêm Food mới')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm Món ăn mới</h1>
    </div>

    <!-- Breadcrumb -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.food.index') }}">Món ăn</a></li>
        <li class="breadcrumb-item active">Thêm mới</li>
    </ol>

    <!-- Form Card -->
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-clipboard-list me-2"></i> Nhập thông tin Món ăn mới</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('admin.food.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="food_name" class="form-label"><i class="fas fa-signature me-1"></i> Tên Món ăn <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('food_name') is-invalid @enderror" id="food_name" name="food_name" value="{{ old('food_name') }}" placeholder="Nhập tên món ăn" required>
                    @error('food_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="food_type" class="form-label"><i class="fas fa-utensils me-1"></i> Loại Món ăn</label>
                    <input type="text" class="form-control @error('food_type') is-invalid @enderror" id="food_type" name="food_type" value="{{ old('food_type') }}" placeholder="Ví dụ: Món khai vị, Món chính, ...">
                    @error('food_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="food_price" class="form-label"><i class="fas fa-dollar-sign me-1"></i> Giá (VNĐ) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="number" step="0.01" class="form-control @error('food_price') is-invalid @enderror" id="food_price" name="food_price" value="{{ old('food_price') }}" placeholder="Nhập giá món ăn" required>
                        <span class="input-group-text">VNĐ</span>
                    </div>
                    @error('food_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="food_description" class="form-label"><i class="fas fa-file-alt me-1"></i> Mô tả Món ăn</label>
                    <textarea class="form-control @error('food_description') is-invalid @enderror" id="food_description" name="food_description" rows="4" placeholder="Nhập mô tả chi tiết về món ăn">{{ old('food_description') }}</textarea>
                    @error('food_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="food_image" class="form-label"><i class="fas fa-image me-1"></i> Hình ảnh Món ăn</label>
                    <input type="file" class="form-control @error('food_image') is-invalid @enderror" id="food_image" name="food_image">
                    @error('food_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text mt-2">Chọn hình ảnh để tải lên (tùy chọn).</div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary shadow-sm">
                        <i class="fas fa-save fa-sm text-white-50 me-1"></i> Lưu Món ăn
                    </button>
                    <a href="{{ route('admin.food.index') }}" class="btn btn-secondary">
                        <i class="fas fa-ban fa-sm text-white-50 me-1"></i> Hủy bỏ
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection