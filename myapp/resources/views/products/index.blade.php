@extends('layouts.app')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <h1>Danh sách sản phẩm</h1>
    <a href="{{ route('products.create') }}">+ Thêm sản phẩm</a>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th><th>Tên</th><th>Giá</th><th>Số lượng</th><th>Hành động</th>
        </tr>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>
                <a href="{{ route('products.show', $product) }}">Xem</a> |
                <a href="{{ route('products.edit', $product) }}">Sửa</a> |
                <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Xóa sản phẩm này?')">Xóa</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
