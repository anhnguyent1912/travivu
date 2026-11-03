<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InformationController extends Controller
{
    public function index()
    {
        $title = 'Thông tin cá nhân';
        return view('clients.infor', compact('title'));
    }
    public function update(Request $request)
    {
        $data = $request->validate([
            'fullname' => ['present', 'nullable', 'string', 'max:70'],
            'phoneNumber' => ['present', 'nullable', 'string', 'regex:/\A[0-9]{10}\z/'],
            'address' => ['present', 'nullable', 'string', 'max:255'],
        ], [
            'present' => 'Biểu mẫu thiếu thông tin. Vui lòng tải lại trang.',
            'string' => 'Giá trị nhập vào không hợp lệ.',
            'fullname.max' => 'Họ và tên không được vượt quá 70 ký tự.',
            'phoneNumber.regex' => 'Số điện thoại phải gồm 10 chữ số.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
        ]);
        $user = $request->user();

        $user->fullname = $data['fullname'];
        $user->phoneNumber = $data['phoneNumber'];
        $user->address = $data['address'];
        $user->save();

        return redirect()
            ->route('user-profile')
            ->with('success', 'Cập nhật thông tin cá nhân thành công.');
    }

    public function updatePassword(Request $request)
    {
        if ($request->session()->get('login_method') !== 'password') {
            abort(403, 'Đăng nhập bằng Google, không thể đổi mật khẩu.');
        }

        $data = $request->validate([
            'current_password' => ['bail', 'required', 'string', 'current_password:web'],
            'password' => [
                'bail',
                'required',
                'string',
                'min:8',
                'different:current_password',
                function ($attribute, $value, $fail) {
                    if (strlen($value) > 72 || str_contains($value, "\0")) {
                        $fail('Mật khẩu mới không hợp lệ hoặc vượt quá 72 byte.');
                    }
                },
            ],
            'password_confirmation' => ['bail', 'required', 'same:password'],
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại.',
            'current_password.string' => 'Mật khẩu hiện tại không hợp lệ.',
            'current_password.current_password' => 'Mật khẩu hiện tại không đúng.',
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.string' => 'Mật khẩu mới không hợp lệ.',
            'password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'password.different' => 'Mật khẩu mới phải khác mật khẩu hiện tại.',
            'password_confirmation.required' => 'Vui lòng nhập lại mật khẩu mới.',
            'password_confirmation.same' => 'Xác nhận mật khẩu mới không khớp.',
        ]);

        $user = $request->user();
        $user->password = Hash::make($data['password']);
        $user->save();

        $request->session()->regenerate(true);

        return redirect()
            ->route('user-profile')
            ->with('success', 'Cập nhật mật khẩu thành công.');
    }
}
