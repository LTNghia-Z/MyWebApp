<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function showLoginForm(Request $request)
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
        );

        $account = Account::where('email', $request->email)->first();

        if (!$account) {
            return redirect()->back()->with('error', '
                Email không tồn tại');
        }

        $user = $account->username;
        $account_id = $account->id;

        $password = $request->password;

        if ($account->password != $password) {
            return redirect()->back()->with('error', '
                Mật khẩu không chính xác');
        }

        $request->session()->put('account', $user);
        $request->session()->put('account_id', $account_id);

        return redirect()->route('user.index');
    }

    public function showRegisterForm(Request $request)
    {
        return view('auth.register');
    }

    public function register(Request $request)

    {
        $request->validate(
            [
                'username' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|max:32',
                'phone' => 'required|numeric|digits_between:10,10',
            ],
        );

        $account = new Account();

        $account->username = $request->username;
        $account->email = $request->email;
        $account->password = $request->password;
        $account->address = $request->address;
        $account->phone = $request->phone;

        $account->save();

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('account');
        $request->session()->forget('account_id');

        return redirect()->route('login');
    }
}
