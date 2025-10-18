<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách đơn hàng.
     */
    public function index()
    {
        $orders = Order::orderBy("id", "desc")->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Hiển thị form tạo đơn hàng.
     */
    public function create()
    {
        $foods = Food::all();
        $accounts = Account::all();
        return view('admin.order.create', compact('foods', 'accounts'));
    }

    /**
     * Lưu đơn hàng mới vào database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'account_id'  => 'required|exists:accounts,id',
            'foods'       => 'required|array',
            'foods.*'     => 'exists:foods,id',
            'quantities'  => 'required|array',
            'quantities.*'=> 'integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'address'     => 'required|json',
            'status'      => 'required|string|in:pending,delivering,completed,canceled',
            'phone'       => 'required|string',
        ]);

        // Xử lý trường address: nếu là chuỗi JSON thì decode, nếu đã là array thì dùng luôn
        if (is_array($validated['address'])) {
            $addressArray = $validated['address'];
        } else {
            $addressArray = json_decode($validated['address'], true);
        }

        // Tạo đơn hàng mới, lưu address dưới dạng mảng (Model sẽ tự cast thành JSON)
        $order = Order::create([
            'account_id'  => $validated['account_id'],
            'total_price' => $validated['total_price'],
            'status'      => $validated['status'],
            'address'     => $addressArray,
            'phone'       => $validated['phone'],
        ]);

        // Thêm các món vào bảng order_items
        foreach ($validated['foods'] as $index => $food_id) {
            $quantity = $validated['quantities'][$index] ?? 1;
            $food = Food::findOrFail($food_id);

            OrderItem::create([
                'order_id' => $order->id,
                'food_id'  => $food_id,
                'quantity' => $quantity,
                'price'    => $food->food_price,
            ]);
        }

        return redirect()->route('admin.order.index')->with('success', 'Đơn hàng đã được tạo thành công!');
    }

    /**
     * Hiển thị chi tiết đơn hàng.
     */
    public function show($id)
    {
        $order = Order::with('account', 'orderItems.food')
                      ->where('id', $id)
                      ->firstOrFail();

        // Lấy thông tin account nếu cần (order đã có quan hệ account)
        $account = Account::findOrFail($order->account_id);

        // Lấy danh sách món ăn từ orderItems
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        $foods = $orderItems->map(function ($item) {
            return $item->food;
        });
        $quantity = $orderItems->map(function ($item) {
            return $item->quantity;
        });

        return view('admin.order.show', compact('order', 'account', 'foods', 'quantity'));
    }

    /**
     * Hiển thị form chỉnh sửa đơn hàng.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $foods = Food::all();
        $accounts = Account::all();
        return view('admin.order.edit', compact('order', 'foods', 'accounts'));
    }

    /**
     * Cập nhật đơn hàng trong database.
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'foods'       => 'required|array',
            'foods.*'     => 'exists:foods,id',
            'quantities'  => 'required|array',
            'quantities.*'=> 'integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'status'      => 'required|string|in:pending,delivering,completed,cancelled',
            'address'     => 'required|json',
            'phone'       => 'required|string|max:20',
        ]);

        // Xử lý address: nếu đã là array thì dùng luôn, nếu là chuỗi thì decode
        if (is_array($validated['address'])) {
            $addressArray = $validated['address'];
        } else {
            $addressArray = json_decode($validated['address'], true);
        }

        // Cập nhật thông tin đơn hàng (address lưu dưới dạng mảng, Eloquent sẽ tự chuyển thành JSON)
        $order->update([
            'total_price' => $validated['total_price'],
            'status'      => $validated['status'],
            'address'     => $addressArray,
            'phone'       => $validated['phone'],
        ]);

        // Xóa các OrderItem cũ
        $order->orderItems()->delete();

        // Thêm các OrderItem mới dựa trên foods và quantities
        foreach ($validated['foods'] as $index => $food_id) {
            $quantity = $validated['quantities'][$index] ?? 1;
            $food = Food::findOrFail($food_id);

            $order->orderItems()->create([
                'food_id'  => $food_id,
                'quantity' => $quantity,
                'price'    => $food->food_price,
            ]);
        }

        return redirect()->route('admin.order.index')->with('success', 'Cập nhật đơn hàng thành công!');
    }

    /**
     * Xóa đơn hàng khỏi database.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.order.index')->with('success', 'Đơn hàng đã được xóa thành công!');
    }
}
