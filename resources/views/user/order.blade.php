@extends('user.layouts')

@section('content')
<div class="container">
    <h2>Giỏ hàng</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($cart) > 0)
    <!-- Form thanh toán -->
    <form action="{{ route('user.checkout') }}" method="POST" id="checkout-form">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $id => $item)
                    @php 
                        $quantity = old("quantities.$id", $item['quantity']);
                        $subtotal = $item['food_price'] * $quantity; 
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>
                            @if($item['food_image'])
                                <img src="{{ $item['food_image'] }}" width="50" height="50" alt="{{ $item['food_name'] }}">
                            @else
                                <img src="https://via.placeholder.com/50" alt="No Image">
                            @endif
                        </td>
                        <td>
                            {{ $item['food_name'] }}
                            <!-- Gửi ID của món ăn -->
                            <input type="hidden" name="foods[]" value="{{ $id }}">
                        </td>
                        <td>
                            <input type="number" name="quantities[]" class="form-control quantity-input" 
                                   value="{{ $quantity }}" min="1" data-price="{{ $item['food_price'] }}"
                                   style="width: 70px;">
                        </td>
                        <td>{{ number_format($item['food_price']) }} VNĐ</td>
                        <td class="subtotal">{{ number_format($subtotal) }} VNĐ</td>
                        <td>
                            <a href="{{ route('user.remove', $id) }}" class="btn btn-danger btn-sm" 
                               onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-right"><strong>Tổng tiền:</strong></td>
                    <td colspan="2"><strong id="total-price">{{ number_format($total) }} VNĐ</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Thông tin liên hệ -->
        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
        </div>

        <!-- Phần địa chỉ cập nhật -->
        <div class="mb-3">
            <label for="address" class="form-label fw-bold">Địa chỉ</label>
            <div class="row g-2">
                <div class="col-md-4">
                    <select id="province-select" class="form-select">
                        <option value="">-- Chọn Tỉnh/Thành phố --</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select id="district-select" class="form-select" disabled>
                        <option value="">-- Chọn Quận/Huyện --</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select id="ward-select" class="form-select" disabled>
                        <option value="">-- Chọn Phường/Xã --</option>
                    </select>
                </div>
            </div>
            @error('address')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <!-- Input ẩn lưu JSON địa chỉ (được cập nhật qua JS) -->
        <input type="hidden" id="address-json" name="address">

        <!-- Gửi tổng giá -->
        <input type="hidden" id="total-price-input" name="total_price" value="{{ $total }}">

        <!-- Nút Thanh toán -->
        <button type="submit" class="btn btn-success">
            <i class="fas fa-credit-card"></i> Thanh toán
        </button>
    </form>
    @else
        <p>Giỏ hàng trống!</p>
    @endif
</div>
@endsection

<!-- jQuery để hỗ trợ xử lý DOM (nếu chưa có) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Cập nhật tổng tiền khi thay đổi số lượng
    $('.quantity-input').on('input', function() {
        let total = 0;

        $('.quantity-input').each(function() {
            let price = parseFloat($(this).data('price'));
            let quantity = parseInt($(this).val());
            let subtotal = price * quantity;
            total += subtotal;

            // Cập nhật giá trị subtotal trong bảng
            $(this).closest('tr').find('.subtotal').text(subtotal.toLocaleString('vi-VN') + ' VNĐ');
        });

        // Cập nhật tổng tiền
        $('#total-price').text(total.toLocaleString('vi-VN') + ' VNĐ');
        $('#total-price-input').val(total);
    });

});
</script>

<script src="{{ asset('js/address.js') }}"></script>
