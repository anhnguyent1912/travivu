<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginGoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        // hủy đăng nhập trên Google.
        if ($request->has('error')) {
            return redirect()->route('login')
                ->with('error', 'Bạn đã hủy hoặc chưa cho phép đăng nhập Google.');
        }

        try {
            // 1. Nhận thông tin Google.
            $googleUser = Socialite::driver('google')->user();
            $email = Str::lower(trim((string) $googleUser->getEmail()));
            $emailVerified = ($googleUser->getRaw()['email_verified'] ?? false) === true;

            if (! $googleUser->getId() || $email === '' || ! $emailVerified) {
                return redirect()->route('login')
                    ->with('error', 'Google chưa cung cấp email đã xác minh.');
            }

            // 2. Tìm tài khoản đã liên kết với Google.
            $user = User::where('googleid', $googleUser->getId())->first();
            // 3. Chưa có liên kết Google: xử lý tài khoản mới.
            if (! $user) {
                if (User::where('email', $email)->exists()) {
                    return redirect()->route('login')
                        ->with(
                            'error',
                            'Email này đã có tài khoản. Vui lòng đăng nhập bằng mật khẩu; chức năng liên kết Google chưa được hỗ trợ.'
                        );
                }
                $user = new User;
                $user->googleid = $googleUser->getId();
                $user->username = 'google-'.Str::uuid();
                $user->fullname = $googleUser->getName() ?: 'Người dùng Google';
                $user->email = $email;
                $user->password = Hash::make(Str::random(64));
                $user->isActive = 'Y';
                $user->status = null;
                $user->save();
            }
            // 4. Tài khoản bị khóa không được đăng nhập.
            if ($user->status !== null) {
                return redirect()->route('login')
                    ->with('error', 'Tài khoản hiện không được phép đăng nhập.');
            }
            // Chỉ cho phép tài khoản đã kích hoạt đăng nhập.
            if ($user->isActive !== 'Y') {
                return redirect()->route('login')
                    ->with('error', 'Bạn cần kích hoạt tài khoản trước khi đăng nhập.');
            }
            // 5. Đăng nhập vào website.
            Auth::login($user);
            $request->session()->regenerate();
            $request->session()->put('login_method', 'google');

            return redirect()->route('home');
        } catch (Exception $e) {
            report($e);

            return redirect()->route('login')
                ->with('error', 'Không thể đăng nhập Google lúc này. Vui lòng thử lại.');
        }
    }
}
