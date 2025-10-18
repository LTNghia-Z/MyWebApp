<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        // Kiểm tra xem admin đã đăng nhập chưa, nếu rồi thì redirect đến dashboard
        if (Session::has('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.index'); // Hiển thị trang login nếu chưa đăng nhập
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Xác thực cứng user và password (trong thực tế bạn sẽ dùng database)
        if ($username == 'admin' && $password == 'admin') {
            // Lưu trạng thái đăng nhập vào session
            Session::put('admin_logged_in', true);
            return redirect()->route('admin.dashboard');
        } else {
            // Đăng nhập thất bại, quay lại trang login với thông báo lỗi
            return redirect()->route('admin.index')->withErrors(['login' => 'Sai tên đăng nhập hoặc mật khẩu.']);
        }
    }

    public function dashboard()
    {

        // Thống kê tổng quan
    $totalCustomers = Account::count();
    $totalOrders = Order::count();
    $totalRevenue = Order::where('status', 'completed')->sum('total_price');
    $totalFoods = Food::count();

    // Thống kê doanh thu theo tháng
    $monthlyRevenue = Order::where('status', 'completed')
        ->selectRaw('SUM(total_price) as revenue, MONTH(created_at) as month')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Chuyển dữ liệu thành array
    $revenueData = [
        'labels' => $monthlyRevenue->pluck('month')->map(fn($m) => "Tháng $m")->toArray(),
        'data' => $monthlyRevenue->pluck('revenue')->toArray(),
    ];
        // Kiểm tra xem admin đã đăng nhập chưa, nếu chưa thì redirect về trang login
        if (!Session::has('admin_logged_in')) {
            return redirect()->route('admin.index');
        }
        return view('admin.dashboard',compact(
            'totalCustomers',  'totalCustomers', 'totalOrders', 'totalRevenue', 'totalFoods', 'revenueData')); // Hiển thị trang dashboard
    }

    public function logout()
    {
        Session::forget('admin_logged_in'); // Xóa trạng thái đăng nhập khỏi session
        return redirect()->route('admin.index'); // Chuyển về trang login
    }
}