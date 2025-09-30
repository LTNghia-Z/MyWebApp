<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\products;
class ProductsController extends Controller
{
    public function createProducts(Request $request)
    {
        $fields = $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        Products::create($fields);

        return redirect('/')->with('message', 'Tạo sản phẩm thành công');
    }
    public function destroy($id){
        
        $products = products::find($id);
        if($products != null){
            $products->delete();
            return redirect('/')->with('message', 'Xoa sản phẩm thành công');
        }
        
    }
    public function editProducts($id){
        $product = products::find($id);
        return view('edit-products', compact('product'));
    }
    public function updateProducts(Request $request,$id){
        $products = products::find($id);
        $fields = $request->validate([
            'name'  => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);
        $products->update($fields);
        return redirect('/')->with('message', 'Sua sản phẩm thành công');
    }
}
