@extends('admin.layouts')

@section('title', 'Chi tiết Khách hàng')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chi tiết Khách hàng</h1>
    </div>

    <!-- Breadcrumb -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}">Khách hàng</a></li>
        <li class="breadcrumb-item active">Chi tiết</li>
    </ol>

    <!-- Customer Detail Card -->
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle me-2"></i> Thông tin chi tiết Khách hàng</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="mb-3 row">
                <div class="col-md-2 font-weight-bold"><i class="fas fa-user me-1"></i> Tên Khách hàng:</div>
                <div class="col-md-10">
                    <p class="form-control-plaintext">{{ $customer->username }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-2 font-weight-bold"><i class="fas fa-envelope me-1"></i> Email:</div>
                <div class="col-md-10">
                    <p class="form-control-plaintext">{{ $customer->email }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-2 font-weight-bold"><i class="fas fa-phone-alt me-1"></i> Số điện thoại:</div>
                <div class="col-md-10">
                    <p class="form-control-plaintext">{{ $customer->phone }}</p>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-2 font-weight-bold"><i class="fas fa-map-marker-alt me-1"></i> Địa chỉ:</div>
                <div class="col-md-10">
                    @php
                    $address = $customer->address ? json_decode($customer->address, true) : null;
                    @endphp
                    <p class="form-control-plaintext">
                        {{ $address['ward']['name'] ?? 'N/A' }},
                        {{ $address['district']['name'] ?? 'N/A' }},
                        {{ $address['province']['name'] ?? 'N/A' }}
                    </p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.customer.edit', $customer->id) }}" class="btn btn-warning shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50 me-1"></i> Chỉnh sửa
                </a>
                <a href="{{ route('admin.customer.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left fa-sm text-white-50 me-1"></i> Quay lại danh sách
                </a>
            </div>
        </div>
    </div>
</div>
@endsection