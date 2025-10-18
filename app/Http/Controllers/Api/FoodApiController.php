<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;    
use App\Models\OrderItem; 
use App\Models\Food; 

class FoodApiController extends Controller
{
    public function index()
    {
        return response()->json(Food::all());
    }

    public function show($id)
    {
        $food = Food::find($id);
        if (!$food) {
            return response()->json(['error' => 'Không tìm thấy món ăn'], 404);
        }
        return response()->json($food);
    }

    public function store(Request $request)
    {
        $request->validate([
            'food_name' => 'required|string',
            'food_price' => 'required|numeric',
            'food_type' => 'nullable|string',
        ]);

        $food = Food::create($request->all());
        return response()->json(['message' => 'Thêm món ăn thành công', 'food' => $food], 201);
    }

    public function update(Request $request, $id)
    {
        $food = Food::find($id);
        if (!$food) return response()->json(['error' => 'Không tìm thấy món ăn'], 404);

        $food->update($request->all());
        return response()->json(['message' => 'Cập nhật thành công', 'food' => $food]);
    }

    public function destroy($id)
    {
        $food = Food::find($id);
        if (!$food) return response()->json(['error' => 'Không tìm thấy món ăn'], 404);

        $food->delete();
        return response()->json(['message' => 'Đã xóa món ăn']);
    }
}

