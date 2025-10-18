@extends('admin.layouts')

@section('title', 'Tạo đơn hàng mới')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tạo Đơn hàng mới</h1>
    </div>

    <!-- Breadcrumb -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.order.index') }}">Đơn hàng</a></li>
        <li class="breadcrumb-item active">Tạo mới</li>
    </ol>

    <!-- Create Order Card -->
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-plus me-2"></i> Nhập thông tin Đơn hàng mới</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('admin.order.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="account_id" class="form-label"><i class="fas fa-user me-1"></i> Khách hàng <span class="text-danger">*</span></label>
                    <select name="account_id" id="account_id" class="form-control @error('account_id') is-invalid @enderror" required>
                        <option value="">-- Chọn khách hàng --</option>
                        @foreach ($accounts as $account)
                        <option value="{{ $account->id }}" {{ old('account_id') == $account->id ? 'selected' : '' }}>
                            {{ $account->username }}
                        </option>
                        @endforeach
                    </select>
                    @error('account_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="foods" class="form-label"><i class="fas fa-utensils me-1"></i> Chọn món ăn <span class="text-danger">*</span></label>
                    <div id="food-list">
                        <div class="d-flex align-items-center mb-2 food-item" id="default-food-item">
                            <select name="foods[]" class="form-control food-select">
                                <option value="">-- Chọn món ăn --</option>
                                @foreach ($foods as $food)
                                <option value="{{ $food->id }}" data-price="{{ $food->food_price }}">
                                    {{ $food->food_name }} ({{ number_format($food->food_price, 0, ',', '.') }} VNĐ)
                                </option>
                                @endforeach
                            </select>
                            <input type="number" name="quantities[]" class="form-control ms-2 quantity-input" placeholder="Số lượng" min="1" value="1">
                            <button type="button" class="btn btn-danger ms-2 remove-food"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                    <button type="button" id="add-food" class="btn btn-primary shadow-sm mt-2"><i class="fas fa-plus fa-sm text-white-50"></i> Thêm món</button>
                </div>
                <!-- Tổng giá -->
                <div class="mb-3">
                    <label for="total_price" class="form-label"><i class="fas fa-dollar-sign me-1"></i> Tổng giá <span class="text-danger">*</span></label>
                    <div id="total_price_display" class="form-control bg-light border-0"><i class="fas fa-coins me-1 text-muted"></i> 0 VNĐ</div>
                    <input type="hidden" name="total_price" id="total_price" value="0">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label"><i class="fas fa-tasks me-1"></i> Trạng thái <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="">-- Chọn trạng thái --</option>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="canceled" {{ old('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                    @error('status')
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


                <div class="mb-3">
                    <label for="phone" class="form-label"><i class="fas fa-phone-alt me-1"></i> Số điện thoại <span class="text-danger">*</span></label>
                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Nhập số điện thoại" required>
                    @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-success shadow-sm">
                        <i class="fas fa-save fa-sm text-white-50 me-1"></i> Lưu đơn hàng
                    </button>
                    <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">
                        <i class="fas fa-ban fa-sm text-white-50 me-1"></i> Hủy bỏ
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Script để tính toán total_price -->
<script>
    $(document).ready(function() {
        function updateTotalPrice() {
            let total = 0;
            $('.food-item').each(function() {
                let foodSelect = $(this).find('.food-select');
                let quantityInput = $(this).find('.quantity-input');

                let price = parseFloat(foodSelect.find(':selected').data('price')) || 0;
                let quantity = parseInt(quantityInput.val()) || 1;
                total += price * quantity;
            });

            $('#total_price').val(total);
            $('#total_price_display').html('<i class="fas fa-coins me-1 text-muted"></i> ' + total.toLocaleString('vi-VN') + ' VNĐ');
        }

        // Khi thay đổi món ăn hoặc số lượng
        $(document).on('change', '.food-select, .quantity-input', updateTotalPrice);

        // Thêm món mới
        $('#add-food').click(function() {
            let newFoodRow = $('#default-food-item').clone();
            newFoodRow.removeAttr('id').removeAttr('style'); // Remove id and style to avoid duplication and display issues
            $('#food-list').append(newFoodRow);
        });


        // Xóa món ăn
        $(document).on('click', '.remove-food', function() {
            $(this).closest('.food-item').remove();
            updateTotalPrice();
        });

        updateTotalPrice();
    });
</script>

<script src="{{asset('js/address.js')}}"></script>

@endsection