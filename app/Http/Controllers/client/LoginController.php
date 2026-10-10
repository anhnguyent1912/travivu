<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\client\login;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    private $login;

    public function __construct()
    {
        $this->login = new login();
    }
    public function index()
    {
        $title = 'Đăng nhập';
        return view(view: 'clients.login', data: compact('title'));
    }


    public function register(Request $request)
    {
        $username_regis = $request->username_regis;
        $email = $request->email;
        $password_regis = $request->password_regis;
        $checkAccountExist = $this->login->checkUserExist(username: $username_regis, email: $email);
        if ($checkAccountExist) {
            return response()->json([
                'success' => false,
                'message' => 'Tên đăng nhập hoặc email đã tồn tại.',
            ]);
        }
        $activation_token = Str::random(60);
        $created = $this->login->registerAcount(data: [
            'username' => $username_regis,
            'email' => $email,
            'password' => Bcrypt($password_regis),
            'activation_token' => $activation_token
            // 'isActive' => 'n',
        ]);
        $this->sendActivationEmail($email, $activation_token);
        return response()->json([
            'success' => true,
            'message' => 'Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.'
        ]);

    }
    public function sendActivationEmail($email,$token)
    {
        $activation_link = route('activate.account', ['token' => $token]);
        Mail::send('clients.mail.mail_active', ['link' => $activation_link], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Kích hoạt tài khoản');
        });
    }
    public function activateAccount($token)
    {
        $user = $this->login->getUserByToken(token: $token);
        if ($user) {
            $this->login->activateUserAccount(token: $token);
            return redirect()->route('login')->with('message', 'Tài khoản của bạn đã được kích hoạt');
        }else {
            return redirect()->route('login')->with('error', 'Liên kết kích hoạt không hợp lệ');
        }
    }
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $data_login = [
            'username' => $username,
            'password' => Bcrypt($password)
        ];

        // Lấy thông tin user đăng nhập
        $user_login = $this->login->login($data_login);

        if ($user_login != null) {
            // Kiểm tra xem tài khoản đã kích hoạt qua email chưa (nếu có cột isActive)
            if (isset($user_login->isActive) && $user_login->isActive !== 'y') {
                return response()->json([
                    'success' => false,
                    'message' => 'Tài khoản chưa được kích hoạt qua email. Vui lòng kiểm tra hộp thư!',
                ]);
            }

            // Lưu session trực tiếp từ kết quả trả về của user_login
            $request->session()->put('username', $user_login->username);
            $request->session()->put('avatar', $user_login->avatar ?? 'default-avatar.png');

            if (function_exists('toastr')) {
                toastr()->success("Đăng nhập thành công!", 'Thông báo');
            }

            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công!',
                'redirectUrl' => route('home'), // Đảm bảo trong routes/web.php đã có ->name('home')
            ]);

        } else {
            return response()->json([
                'success' => false,
                'message' => 'Thông tin tài khoản hoặc mật khẩu không chính xác!',
            ]);
        }
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
