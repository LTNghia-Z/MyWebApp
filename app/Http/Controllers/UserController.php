<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendUserPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $foods = Food::all();
        return view('user.index', compact('foods'));
    }

    public function customer()
    {
        $customers = Account::all();
        return view('admin.customer.index', compact('customers'));
    }

    public function order()
    {
        // Lấy dữ liệu giỏ hàng từ session
        $cart = session()->get('cart', []);
        return view('user.order', compact('cart'));
    }

    // Thêm món ăn vào giỏ (lưu vào session)
    public function add(Request $request, $id)
    {
        // Lấy món ăn theo id
        $food = Food::findOrFail($id);

        // Lấy giỏ hàng từ session hoặc khởi tạo mảng rỗng
        $cart = session()->get('cart', []);

        // Nếu đã có món ăn trong giỏ thì tăng số lượng, nếu chưa có thì thêm mới
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "food_name"  => $food->food_name,
                "food_price" => $food->food_price,
                "quantity"   => 1,
                "food_image" => $food->food_image,
            ];
        }

        // Lưu lại giỏ hàng vào session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    public function show($id)
    {
        $customer = Account::findOrFail($id);
        return view('admin.customer.show', compact('customer'));
    }

    public function create()
    {
        return view('admin.customer.create');
    }

    public function checkout(Request $request)
    {
        // Kiểm tra nếu không có account trong session thì chuyển hướng đến trang đăng nhập
        if (!$request->session()->has('account_id')) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để đặt hàng!');
        }

        $request->validate([
            'foods'       => 'required|array',
            'foods.*'     => 'exists:foods,id',
            'quantities'  => 'required|array',
            'quantities.*'=> 'integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'address'     => 'required|json',
            'phone'       => 'required|string',
        ]);

        // Lấy thông tin người dùng từ session
        $account = $request->session()->get('account_id');

        // Xử lý trường address: nếu là array thì dùng luôn, nếu là chuỗi thì decode
        if (is_array($request->address)) {
            $addressArray = $request->address;
        } else {
            $addressArray = json_decode($request->address, true);
        }

        // Tạo đơn hàng mới (giả sử model Order có cast address => 'array')
        $order = Order::create([
            'account_id'  => $account,
            'total_price' => $request->total_price,
            'status'      => 'pending',
            'address'     => $addressArray, // Lưu mảng, Eloquent sẽ tự chuyển thành JSON
            'phone'       => $request->phone,
        ]);

        // Thêm các món vào bảng order_items
        foreach ($request->foods as $index => $food_id) {
            if (!isset($request->quantities[$index])) {
                return redirect()->back()->with('error', 'Số lượng sản phẩm không hợp lệ.');
            }

            OrderItem::create([
                'order_id' => $order->id,
                'food_id'  => $food_id,
                'quantity' => (int) $request->quantities[$index],
                'price'    => Food::find($food_id)->food_price,
            ]);
        }

        // Xóa giỏ hàng khỏi session sau khi đặt hàng thành công
        session()->forget('cart');

        // Gửi dữ liệu đơn hàng mới về trang admin
        session()->flash('new_order', [
            'id'         => $order->id,
            'account_id' => $account,
            'total_price'=> $request->total_price,
            'phone'      => $request->phone,
            'status'     => 'pending',
            'created_at' => now()->format('Y-m-d H:i:s'),
        ]);

        return redirect()->route('user.index')->with('success', 'Đơn hàng của bạn đã được đặt thành công!');
    }

    // Phương thức xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }

    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'username' => 'required',
            'email'    => 'required|email|unique:accounts,email',
            'phone'    => 'required|numeric|digits_between:10,10',
            'address'  => 'required|json',
        ]);

        // Xử lý trường address: nếu là array thì dùng luôn, nếu là chuỗi thì decode
        if (is_array($request->address)) {
            $addressArray = $request->address;
        } else {
            $addressArray = json_decode($request->address, true);
        }

        // Tạo mật khẩu ngẫu nhiên
        $randomPassword = Str::random(10);

        // Lưu thông tin khách hàng vào database
        $account = new Account();
        $account->username = $request->username;
        $account->email = $request->email;
        $account->password = Hash::make($randomPassword);
        $account->phone = $request->phone;
        // Nếu Account model chưa có cast address, ta lưu dưới dạng chuỗi JSON
        $account->address = json_encode($addressArray);
        $account->save();

        // Gửi email chứa mật khẩu cho khách hàng
        Mail::to($account->email)->send(new SendUserPassword($account->username, $randomPassword));

        return redirect()->route('admin.customer.index')->with('success', 'Thêm khách hàng thành công! Mật khẩu đã được gửi qua email.');
    }

    public function edit($id)
    {
        $customer = Account::findOrFail($id);
        return view('admin.customer.edit', compact('customer'));
    }

    public function profile()
    {
        $account = Account::findOrFail(session()->get('account_id'));
        return view('user.profile', compact('account'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'email'    => 'required|email',
            'phone'    => 'required|numeric|digits_between:10,10',
            'address'  => 'required|json',
        ]);

        // Xử lý trường address: nếu là array thì dùng luôn, nếu là chuỗi thì decode
        if (is_array($request->address)) {
            $addressArray = $request->address;
        } else {
            $addressArray = json_decode($request->address, true);
        }

        $account = Account::findOrFail($id);
        $account->username = $request->username;
        $account->email = $request->email;
        $account->phone = $request->phone;
        $account->address = json_encode($addressArray);
        $account->save();

        return redirect()->route('admin.customer.index')->with('success', 'Cập nhật khách hàng thành công!');
    }

    public function update_profile(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'email'    => 'required|email',
            'phone'    => 'required|numeric|digits_between:10,10',
            'address'  => 'required|json',
        ]);

        // Xử lý trường address: nếu là array thì dùng luôn, nếu là chuỗi thì decode
        if (is_array($request->address)) {
            $addressArray = $request->address;
        } else {
            $addressArray = json_decode($request->address, true);
        }

        $account = Account::findOrFail($id);
        $account->username = $request->username;
        $account->email = $request->email;
        $account->phone = $request->phone;
        $account->address = json_encode($addressArray);
        $account->save();

        return redirect()->route('user.profile')->with('success', 'Cập nhật khách hàng thành công!');
    }

    public function destroy($id)
    {
        $account = Account::findOrFail($id);
        $account->delete();
        return redirect()->route('admin.customer.index')->with('success', 'Xóa khách hàng thành công!');
    }
}
