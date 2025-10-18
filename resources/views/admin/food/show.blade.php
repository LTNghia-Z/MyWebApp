@extends('admin.layouts')

@section('title', 'Chi tiết Food')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chi tiết Món ăn</h1>
    </div>

    <!-- Breadcrumb -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.food.index') }}">Món ăn</a></li>
        <li class="breadcrumb-item active">Chi tiết</li>
    </ol>

    <!-- Detail Card -->
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle me-2"></i> Thông tin chi tiết Món ăn</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-2 font-weight-bold"><i class="fas fa-signature me-1"></i> Tên Món ăn:</div>
                <div class="col-md-10">{{ $food->food_name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 font-weight-bold"><i class="fas fa-utensils me-1"></i> Loại Món ăn:</div>
                <div class="col-md-10">{{ $food->food_type }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 font-weight-bold"><i class="fas fa-dollar-sign me-1"></i> Giá:</div>
                <div class="col-md-10">{{ number_format($food->food_price, 0, ',', '.') }} VNĐ</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 font-weight-bold"><i class="fas fa-file-alt me-1"></i> Mô tả:</div>
                <div class="col-md-10">{{ $food->food_description }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 font-weight-bold"><i class="fas fa-image me-1"></i> Hình ảnh:</div>
                <div class="col-md-10">
                    @if ($food->food_image)
                        <img src="{{ $food->food_image }}" alt="{{ $food->food_name }}" width="250" class="img-thumbnail">
                    @else
                        <span class="text-muted">Không có ảnh</span>
                    @endif
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.food.edit', $food->id) }}" class="btn btn-warning shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50 me-1"></i> Chỉnh sửa
                </a>
                <a href="{{ route('admin.food.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left fa-sm text-white-50 me-1"></i> Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</div>
@endsection