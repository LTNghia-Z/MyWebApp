@extends('admin.layouts')

@section('title', 'Chỉnh sửa Food')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa Món ăn</h1>
    </div>

    <!-- Breadcrumb -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.food.index') }}">Món ăn</a></li>
        <li class="breadcrumb-item active">Chỉnh sửa</li>
    </ol>

    <!-- Edit Card -->
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-edit me-2"></i> Chỉnh sửa thông tin Món ăn</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('admin.food.update', $food->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="food_name" class="form-label"><i class="fas fa-signature me-1"></i> Tên Món ăn <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('food_name') is-invalid @enderror" id="food_name" name="food_name" value="{{ old('food_name', $food->food_name) }}" placeholder="Nhập tên món ăn" required>
                    @error('food_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="food_type" class="form-label"><i class="fas fa-utensils me-1"></i> Loại Món ăn</label>
                    <input type="text" class="form-control @error('food_type') is-invalid @enderror" id="food_type" name="food_type" value="{{ old('food_type', $food->food_type) }}" placeholder="Ví dụ: Món khai vị, Món chính, ...">
                    @error('food_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="food_price" class="form-label"><i class="fas fa-dollar-sign me-1"></i> Giá (VNĐ) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="number" step="0.01" class="form-control @error('food_price') is-invalid @enderror" id="food_price" name="food_price" value="{{ old('food_price', $food->food_price) }}" placeholder="Nhập giá món ăn" required>
                        <span class="input-group-text">VNĐ</span>
                    </div>
                    @error('food_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="food_description" class="form-label"><i class="fas fa-file-alt me-1"></i> Mô tả Món ăn</label>
                    <textarea class="form-control @error('food_description') is-invalid @enderror" id="food_description" name="food_description" rows="4" placeholder="Nhập mô tả chi tiết về món ăn">{{ old('food_description', $food->food_description) }}</textarea>
                    @error('food_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fas fa-image me-1"></i> Hình ảnh hiện tại</label>
                    <div>
                        @if ($food->food_image)
                            <img src="{{ $food->food_image }}" alt="{{ $food->food_name }}" width="150" class="img-thumbnail d-block mb-2">
                        @else
                            <span class="text-muted d-block mb-2">Không có ảnh hiện tại</span>
                        @endif
                    </div>
                    <label for="food_image" class="form-label"><i class="fas fa-upload me-1"></i> Chọn hình ảnh mới (nếu muốn thay đổi)</label>
                    <input type="file" class="form-control @error('food_image') is-invalid @enderror" id="food_image" name="food_image">
                    @error('food_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text mt-2">Chọn hình ảnh mới để thay thế hình ảnh hiện tại (tùy chọn).</div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-warning shadow-sm">
                        <i class="fas fa-save fa-sm text-white-50 me-1"></i> Cập nhật Món ăn
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