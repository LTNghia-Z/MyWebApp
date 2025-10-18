@extends('admin.layouts')

@section('title', 'Quản lý Food')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản lý Món ăn</h1>
        <a href="{{ route('admin.food.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Thêm Món ăn
        </a>
    </div>

    <!-- Breadcrumb -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Món ăn</li>
    </ol>

    <!-- DataTales Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-utensils"></i> Danh sách Món ăn</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>Tên Món ăn</th>
                            <th>Loại Món ăn</th>
                            <th>Giá</th>
                            <th>Hình ảnh</th>
                            <th style="width: 150px;">Hành động</th> <!-- Điều chỉnh độ rộng cột Hành động -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($foods as $food)
                        <tr >
                            <td>{{ $food->food_name }}</td>
                            <td>{{ $food->food_type }}</td>
                            <td>{{ number_format($food->food_price, 0, ',', '.') }} VNĐ</td>
                            <td class="text-center"> <!-- Canh giữa nội dung hình ảnh -->
                                @if ($food->food_image)
                                    <img src="{{ $food->food_image }}" alt="{{ $food->food_name }}" width="60" class="img-thumbnail"> <!-- Tăng kích thước ảnh và bo tròn -->
                                @else
                                    <span class="text-muted">Không có ảnh</span> <!-- Chữ xám khi không có ảnh -->
                                @endif
                            </td>
                            <td class="text-center"> <!-- Canh giữa các nút hành động -->
                                <div class="btn-group gap-1" role="group" aria-label="Food Actions">
                                    <a href="{{ route('admin.food.show', $food->id) }}" class="btn btn-sm btn-info" title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.food.edit', $food->id) }}" class="btn btn-sm btn-warning" title="Chỉnh sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.food.destroy', $food->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa món ăn này?')" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Xóa">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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
                "info": "Hiển thị _START_ đến _END_ của _TOTAL_ món ăn",
                "emptyTable": "Không có dữ liệu món ăn" // Thêm tùy chọn ngôn ngữ cho emptyTable
            },
            "initComplete": function(settings, json) { // Hàm callback sau khi DataTable được khởi tạo xong
                $('#dataTable_filter input').attr('placeholder', 'Nhập từ khóa tìm kiếm...'); // Đặt placeholder cho ô tìm kiếm
            }
        });
    });
</script>
@endsection

@endsection