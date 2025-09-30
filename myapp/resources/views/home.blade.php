<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>xin chao</h1>
    <div>
       <h2>dang ky</h2> 
       <form action="/register" method="post">
        @csrf<!-- bao ve tan cong csrf -->
        <input type="name" placeholder="nhap ten" name="name">
        <input type="email" placeholder="email" name="email">
        <input type="password" placeholder="mat khau" name="password">
        <input type="password" placeholder="mat lai khau" name="password_confirmation">
        <button>Dangky</button>
       </form>  
    </div>
    <h2>San Pham</h2>
    @if(session('message')) 
    <div style="color: red;">{{session('message')}}</div>
    @endif
    <form action="/create-products" method="POST">
   
    @csrf
    <input type="text" name="name" placeholder="Tên sản phẩm">
    <input type="number" name="price" placeholder="Giá sản phẩm">
    <button type="submit">Tạo sản phẩm</button>
</form>

    <div>
    <h2>Danh sách sản phẩm</h2>
    @foreach ($products as $product)
        <div>
            <h3>{{ $product->name }}</h3>
            <h3>{{ $product->price }}</h3>
            <button><a href="/edit-products/{{$product->id}}">Suasp</a></button>
            <form action="/delete-products/{{$product->id}}" method="POST">
                @csrf
                @method('delete')
                <button>delete</button>
            </form>
        </div>
    @endforeach
    </div>

</body>
</html>