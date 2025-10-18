<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;    
use App\Models\OrderItem; 
use App\Models\Food; 

class OrderApiController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems.food')->get();
        return response()->json($orders);
    }

    public function show($id)
    {
        $order = Order::with('orderItems.food')->find($id);
        if (!$order) return response()->json(['error' => 'Không tìm thấy đơn hàng'], 404);
        return response()->json($order);
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_id' => 'required|integer',
            'foods' => 'required|array',
            'quantities' => 'required|array',
            'total_price' => 'required|numeric',
            'address' => 'required',
            'phone' => 'required|string',
        ]);

        $order = Order::create([
            'account_id' => $request->account_id,
            'total_price' => $request->total_price,
            'status' => 'pending',
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        foreach ($request->foods as $i => $food_id) {
            $food = Food::find($food_id);
            if ($food) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'food_id' => $food_id,
                    'quantity' => $request->quantities[$i],
                    'price' => $food->food_price,
                ]);
            }
        }

        return response()->json(['message' => 'Đặt hàng thành công', 'order' => $order], 201);
    }
}