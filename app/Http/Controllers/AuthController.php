<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'username' => 'Thông tin đăng nhập không chính xác.',
        ])->withInput();
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ], [
                'name.required' => 'Vui lòng nhập họ tên!',
                'name.max' => 'Họ tên không được vượt quá 255 ký tự!',
                'username.required' => 'Vui lòng nhập tên đăng nhập!',
                'username.unique' => 'Tên đăng nhập này đã tồn tại!',
                'username.max' => 'Tên đăng nhập không được vượt quá 255 ký tự!',
                'password.required' => 'Vui lòng nhập mật khẩu!',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự!',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp!',
            ]);

            $user = User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
                'role' => 'customer'
            ]);

            Auth::login($user);
            return redirect('/')->with('success', 'Đăng ký thành công! Chào mừng ' . $user->name . ' đến với hệ thống!');
        } catch (\Exception $e) {
            return back()->with('error', 'Có lỗi xảy ra khi đăng ký. Vui lòng thử lại!')->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Đăng xuất thành công!');
    }
}
