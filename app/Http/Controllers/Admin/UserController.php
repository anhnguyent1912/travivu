<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'keyword' => ['nullable', 'string', 'max:100'],
        ], [
            'keyword.string' => 'Từ khóa tìm kiếm không hợp lệ.',
            'keyword.max' => 'Từ khóa tối đa 100 ký tự.',
        ]);

        $keyword = trim($data['keyword'] ?? '');

        $query = User::query()
            ->select('userid', 'username', 'fullname', 'email', 'isActive', 'status');

        if ($keyword !== '') {
            $query->where(function ($q) use ($keyword) {
                $q->where('username', 'like', "%{$keyword}%")
                    ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        $users = $query->orderByDesc('userid')
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'keyword'));
    }

    public function activate(int $userid)
    {
        $updated = User::whereKey($userid)
            ->where('isActive', 'n')
            ->whereNull('status')
            ->update([
                'isActive' => 'Y',
                'activation_token' => null,
            ]);

        if ($updated === 0) {
            return back()->with('admin_error', 'Tài khoản này không thể kích hoạt.');
        }

        return back()->with('admin_success', 'Đã kích hoạt tài khoản khách hàng.');
    }
}
