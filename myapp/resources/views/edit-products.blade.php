<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
</head>
<body>
    <h1>Sửa sản phẩm</h1>

    <form action="/edit-products/{{ $product->id }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $product->name }}" placeholder="Tên sản phẩm">
        <input type="number" name="price" value="{{ $product->price }}" placeholder="Giá sản phẩm">
        <button type="submit">Cập nhật</button>
    </form>

    <a href="/">Quay lại danh sách</a>
</body>
</html>