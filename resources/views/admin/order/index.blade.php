@extends('admin.layouts')

@section('title', 'Danh sách đơn hàng')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách Đơn hàng</h1>
        <a href="{{ route('admin.order.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Thêm Đơn hàng
        </a>
    </div>

    <!-- Breadcrumb -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Đơn hàng</li>
    </ol>

    <!-- Orders Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-shopping-basket me-2"></i> Danh sách Đơn hàng</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Khách hàng</th>
                            <th>Món ăn</th>
                            <th>Số lượng</th>
                            <th>Tổng giá</th>
                            <th>Trạng thái</th>
                            <th class="text-truncate">Địa chỉ</th>
                            <th>SĐT</th>
                            <th style="width: 120px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->account->username ?? 'N/A' }}</td>
                            <td > <!--  No text-truncate for Food column anymore -->
                                <ul class="list-unstyled">
                                    @php
                                        $foodListTitle = ''; // Initialize an empty string for title attribute
                                    @endphp
                                    @foreach ($order->orderItems as $item)
                                        @php
                                            $foodName = $item->food->food_name ?? 'N/A';
                                            $foodPriceFormatted = number_format($item->price, 0, ',', '.');
                                            $foodItemText = "- " . $foodName . " (" . $foodPriceFormatted . " VNĐ)\n"; // Text for title
                                            $foodListTitle .= $foodItemText; // Append to title string
                                        @endphp
                                        <li title="{{ $foodItemText }}" style="cursor: help;"> <!-- Title for each food item and cursor -->
                                            <i class="fas fa-check-circle text-success me-1"></i> {{ $foodName }} (<span class="badge bg-light text-dark">{{ $foodPriceFormatted }} VNĐ</span>)
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul class="list-unstyled">
                                    @foreach ($order->orderItems as $item)
                                    <li>x{{ $item->quantity }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ number_format($order->total_price, 0, ',', '.') }} VNĐ</td>
                            <td>
                                <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'canceled' ? 'danger' : 'warning') }}">
                                    <i class="fas fa-circle-notch fa-spin me-1" 
                                        style="{{ $order->status == 'pending' ? '' : 'display: none;' }}"
                                    ></i>
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="text-truncate" style="max-width: 150px;" title="
                                @php
                                    $address = $order->address;
                                    $fullAddress = 'N/A';
                                    if($address){
                                        $fullAddress = ($address['ward']['name'] ?? 'N/A') . ', ' . ($address['district']['name'] ?? 'N/A') . ', ' . ($address['province']['name'] ?? 'N/A');
                                    }
                                    echo $fullAddress;
                                @endphp
                            ">
                                <p style="cursor: help;"> <!-- Add cursor:help to indicate hover action -->
                                    <i class="fas fa-map-marker-alt text-primary me-1"></i>
                                    {{ $address['ward']['name'] ?? 'N/A' }},
                                    {{ $address['district']['name'] ?? 'N/A' }},
                                    {{ $address['province']['name'] ?? 'N/A' }}
                                </p>
                            </td>
                            <td><i class="fas fa-phone-alt text-info me-1"></i> {{ $order->phone }}</td>
                            <td class="text-center" style="white-space: nowrap;">
                                <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-info btn-sm shadow-sm" title="Xem chi tiết">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.order.edit', $order->id) }}" class="btn btn-warning btn-sm shadow-sm" title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm shadow-sm" title="Xóa">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "ordering": true,
            "paging": true,
            "searching": true,
            "info": true,
            "lengthChange": false,
            "pageLength": 10,
            "language": {
                "search": "Tìm kiếm:",
                "paginate": {
                    "previous": "Trước",
                    "next": "Sau"
                },
                "info": "Hiển thị _START_ đến _END_ của _TOTAL_ đơn hàng",
                "emptyTable": "Không có dữ liệu đơn hàng"
            },
             "initComplete": function(settings, json) {
                $('#dataTable_filter input').attr('placeholder', 'Nhập từ khóa tìm kiếm...');
            }
        });
    });
</script>
@endsection