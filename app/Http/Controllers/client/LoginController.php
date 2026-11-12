<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    public function index()
    {
        $title = 'Đăng nhập';
        return view(view: 'clients.login', data: compact('title'));
    }


    public function register(Request $request)
    {
       $data = $request->validate([
            'username' => [
                'required',
                'string',
                'max:50',
                'unique:tbl_user,username',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:tbl_user,email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                function ($attribute, $value, $fail) {
                    if (strlen($value) > 72) {
                        $fail('Mật khẩu quá dài.');
                    }
                },
            ],
        ], [
            'username.required' => 'Vui lòng nhập tên đăng nhập.',
            'username.string' => 'Tên đăng nhập không hợp lệ.',
            'username.max' => 'Tên đăng nhập không được vượt quá 50 ký tự.',
            'username.unique' => 'Tên đăng nhập đã được sử dụng.',

            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email đã được đăng ký.',

            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.string' => 'Mật khẩu không hợp lệ.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Mật khẩu nhập lại không khớp.',
        ]);
        $user = new User([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
                ]);

        $user->isActive = 'n';
        $user->save();
        return $this->activationResponse($user);
    }
    private function sendActivationEmail(User $user): void
    {
        $token = Str::random(64);

        $user->activation_token = hash('sha256', $token);
        $user->save();

        $link = URL::temporarySignedRoute(
            'activate.account',
            now()->addMinutes(60),
            ['token' => $token]
        );

        Mail::send(
            'clients.mail.mail_active',
            ['link' => $link],
            function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('Kích hoạt tài khoản');
            }
        );
    }
    private function activationResponse(User $user): JsonResponse
    {
        try {
            $this->sendActivationEmail($user);
        } catch (\Throwable $exception) {
            report($exception);

            return response()->json([
                'success' => false,
                'message' => 'Tài khoản đã được tạo nhưng chưa gửi được email. '
                    . 'Vui lòng liên hệ quản trị viên để được hỗ trợ kích hoạt tài khoản.',
            ], 503);
        }

        return response()->json([
            'success' => true,
            'message' => 'Đăng ký thành công! Vui lòng kiểm tra email '
                . 'để kích hoạt tài khoản trong vòng 60 phút.',
        ]);
    }
    public function activateAccount(Request $request, string $token)
    {
        if (! $request->hasValidSignature()) {
            return redirect()->route('login')->with(
                'error',
                'Liên kết kích hoạt không hợp lệ hoặc đã hết hạn.'
            );
        }

        $updated = User::where(
            'activation_token',
            hash('sha256', $token)
        )
            ->where('isActive', 'n')
            ->whereNull('status')
            ->update([
                'isActive' => 'Y',
                'activation_token' => null,
            ]);

        if ($updated === 0) {
            return redirect()->route('login')->with(
                'error',
                'Liên kết đã được sử dụng hoặc tài khoản không thể kích hoạt.'
            );
        }

        return redirect()->route('login')->with(
            'message',
            'Kích hoạt tài khoản thành công. Bạn có thể đăng nhập.'
        );
    }
    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ], [
            'username.required' => 'Vui lòng nhập tên đăng nhập hoặc email.',
            'username.string' => 'Tên đăng nhập hoặc email không hợp lệ.',
            'username.max' => 'Tên đăng nhập hoặc email không được vượt quá 255 ký tự.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.string' => 'Mật khẩu không hợp lệ.',
        ]);

        $identifier = trim($data['username']);

        $field = filter_var($identifier, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        $user = User::where($field, $identifier)->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Tên đăng nhập, email hoặc mật khẩu không chính xác.',
            ], 422);
        }

        if ($user->status !== null) {
            return response()->json([
                'success' => false,
                'message' => 'Tài khoản hiện không được phép đăng nhập.',
            ], 403);
        }

        if ($user->isActive !== 'Y') {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần kích hoạt tài khoản qua email trước khi đăng nhập.',
            ], 403);
        }

        Auth::login($user);
        $request->session()->regenerate();
        $request->session()->put('login_method', 'password');

        return response()->json([
            'success' => true,
            'message' => 'Đăng nhập thành công!',
            'redirectUrl' => route('home'),
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with(
            'message',
            'Bạn đã đăng xuất.'
        );
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
