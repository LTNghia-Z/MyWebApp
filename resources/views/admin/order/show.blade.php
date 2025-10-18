@extends('admin.layouts')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chi tiết Đơn hàng</h1>
    </div>

    <!-- Breadcrumb -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.order.index') }}">Đơn hàng</a></li>
        <li class="breadcrumb-item active">Chi tiết</li>
    </ol>

    <!-- Order Detail Card -->
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle me-2"></i> Thông tin chi tiết Đơn hàng</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="mb-3 row">
                <div class="col-md-2 font-weight-bold"><i class="fas fa-hashtag me-1"></i> Mã đơn hàng:</div>
                <div class="col-md-10">
                    <p class="form-control-plaintext">{{ $order->id }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-2 font-weight-bold"><i class="fas fa-user me-1"></i> Khách hàng:</div>
                <div class="col-md-10">
                    <p class="form-control-plaintext">{{ $account->username ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-2 font-weight-bold"><i class="fas fa-utensils me-1"></i> Món ăn & Số lượng:</div>
                <div class="col-md-10">
                    <ul class="list-unstyled">
                        @if (!empty($foods))
                            @foreach ($foods as $food)
                                <li>
                                    <i class="fas fa-check-circle text-success me-1"></i>
                                    {{ is_array($food) ? $food['food_name'] : $food->food_name }}
                                    <span class="ms-2 badge bg-secondary rounded-pill">x{{ is_array($food) ? $food['quantity'] : $quantity }}</span>
                                </li>
                            @endforeach
                        @else
                            <li>N/A</li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-2 font-weight-bold"><i class="fas fa-dollar-sign me-1"></i> Tổng giá:</div>
                <div class="col-md-10">
                    <p class="form-control-plaintext">{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</p>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-2 font-weight-bold"><i class="fas fa-truck-loading me-1"></i> Trạng thái:</div>
                <div class="col-md-10">
                    <p class="form-control-plaintext">{{ ucfirst($order->status) }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-2 font-weight-bold"><i class="fas fa-map-marker-alt me-1"></i> Địa chỉ:</div>
                <div class="col-md-10">
                    @php
                    $address = $order->address;
                    @endphp
                    <p class="form-control-plaintext">
                        {{ $address['ward']['name'] ?? 'N/A' }},
                        {{ $address['district']['name'] ?? 'N/A' }},
                        {{ $address['province']['name'] ?? 'N/A' }}
                    </p>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-2 font-weight-bold"><i class="fas fa-phone-alt me-1"></i> SĐT:</div>
                <div class="col-md-10">
                    <p class="form-control-plaintext">{{ $order->phone }}</p>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('admin.order.edit', $order->id) }}" class="btn btn-warning shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50 me-1"></i> Chỉnh sửa
                </a>
                <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left fa-sm text-white-50 me-1"></i> Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</div>
@endsection