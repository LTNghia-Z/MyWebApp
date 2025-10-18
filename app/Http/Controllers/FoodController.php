<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    //
    public function index(){
        $foods = Food::All();
        return view('admin.food.index', compact('foods'));
    }

    public function create(){
        return view('
        admin.food.create');
    }
    
    
        public function store(Request $request)
        {
            // Xác thực dữ liệu đầu vào
            $request->validate([
                'food_name' => 'required|string|max:255',
                'food_price' => 'required|numeric',
                'food_type' => 'nullable|string|max:255',
                'food_description' => 'nullable|string',
                'food_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    
            // Khởi tạo đối tượng Food
            $food = new Food();
            $food->food_name = $request->food_name;
            $food->food_type = $request->food_type;
            $food->food_price = $request->food_price;
            $food->food_description = $request->food_description;
    
            // Xử lý lưu ảnh nếu có upload
            if ($request->hasFile('food_image')) {
                $file = $request->file('food_image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = 'uploads/food_images/' . $fileName;
    
                // Lưu ảnh vào thư mục public/uploads/food_images
                $file->move(public_path('uploads/food_images'), $fileName);
    
                // Lưu đường dẫn ảnh vào database
                $food->food_image = asset($filePath);
            }
    
            // Lưu vào database
            $food->save();
    
            // Điều hướng về danh sách với thông báo thành công
            return redirect()->route('admin.food.index')->with('success', 'Thêm món ăn thành công!');
        }
    
    

    public function show($id){
        $food = Food::findOrFail($id);
        return view('admin.food.show', compact('food'));
    }

    public function edit($id){
        $food = Food::findOrFail($id);
        return view('admin.food.edit', compact('food'));
    }

    public function update(Request $request, $id){

        $food = Food::findOrFail($id);
        $food->update($request->all());
        return redirect()->route('admin.food.index', compact('food'));
    }

    public function destroy($id){
        $foods = Food::findOrFail($id);
        $foods->delete();
        return redirect()->route('admin.food.index', compact('foods'));
    }
}
