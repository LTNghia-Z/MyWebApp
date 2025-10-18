@extends('admin.layouts')

@section('title', 'Danh sách khách hàng')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách Khách hàng</h1>
        <a href="{{ route('admin.customer.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Thêm Khách hàng
        </a>
    </div>

    <!-- Breadcrumb -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Khách hàng</li>
    </ol>

    <!-- Customers Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users me-2"></i> Danh sách Khách hàng</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th class="text-truncate">Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th style="width: 120px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td>{{ $customer->username ?? 'N/A' }}</td>
                            <td>{{ $customer->email ?? 'N/A' }}</td>
                            <td class="text-truncate" style="max-width: 150px;">
                                @php
                                $address = $customer->address ? json_decode($customer->address, true) : null;
                                @endphp
                                <p title="
                                    @php
                                        $fullAddress = 'N/A';
                                        if($address){
                                            $fullAddress = ($address['ward']['name'] ?? 'N/A') . ', ' . ($address['district']['name'] ?? 'N/A') . ', ' . ($address['province']['name'] ?? 'N/A');
                                        }
                                        echo $fullAddress;
                                    @endphp
                                ">
                                    <i class="fas fa-map-marker-alt text-primary me-1"></i> <!-- Address icon -->
                                    {{ $address['ward']['name'] ?? 'N/A' }},
                                    {{ $address['district']['name'] ?? 'N/A' }},
                                    {{ $address['province']['name'] ?? 'N/A' }}
                                </p>
                            </td>
                            <td><i class="fas fa-phone-alt text-info me-1"></i> {{ $customer->phone ?? 'N/A' }}</td>
                            <td class="text-center" style="white-space: nowrap;">
                                <a href="{{ route('admin.customer.show', $customer->id) }}" class="btn btn-info btn-sm shadow-sm" title="Xem chi tiết">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.customer.edit', $customer->id) }}" class="btn btn-warning btn-sm shadow-sm" title="Chỉnh sửa">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.customer.destroy', $customer->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa khách hàng này?')">
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
                "info": "Hiển thị _START_ đến _END_ của _TOTAL_ khách hàng",
                "emptyTable": "Không có dữ liệu khách hàng"
            },
            "initComplete": function(settings, json) {
                $('#dataTable_filter input').attr('placeholder', 'Nhập từ khóa tìm kiếm...');
            }
        });
    });
</script>
@endsection