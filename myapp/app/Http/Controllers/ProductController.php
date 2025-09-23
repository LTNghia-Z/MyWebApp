<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Hiển thị danh sách
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // Form thêm mới
    public function create()
    {
        return view('products.create');
    }

    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công');
    }

    // Xem chi tiết
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Form sửa
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Cập nhật
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công');
    }

    // Xóa
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Xóa sản phẩm thành công');
    }
}