<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\client\login;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $created = $this->login->registerAcount(data: [
            'username' => $username_regis,
            'email' => $email,
            'password' => md5($password_regis),
            // 'isActive' => 'n',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Đăng ký thành công! Vui lòng kiểm tra email để kích hoạt tài khoản.'
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
