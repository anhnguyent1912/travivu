<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }
    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Vui lòng nhập tên đăng nhập.',
            'username.string' => 'Tên đăng nhập không hợp lệ.',
            'username.max' => 'Tên đăng nhập tối đa 50 ký tự.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.string' => 'Mật khẩu không hợp lệ.',

        ]);
        $success = Auth::guard('admin')->attempt([
            'userName' => $data['username'],
            'password' => $data['password'],
        ]);
        if (!$success) {
            return back()->withErrors([
                'username' => 'Tên đăng nhập hoặc mật khẩu không đúng,',
            ])
                ->onlyInput('username');
        }
        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }
    public function logout(request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->regenerate();
        return redirect()->route('admin.login');
    }
}
