<?php

namespace App\Models\client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class login extends Model
{
    use HasFactory;
     protected $table = 'tbl_user';

    //Đăng ký người dùng mới
    public function registerAcount($data)
    {

        return DB::table(table: $this->table)->insert($data);
        // $userid = DB::table($this->table)->insertGetId($data);

        // if ($userid) {
        //     return DB::table($this->table)->where('userid', $userid)->first();
        // }

        // return null;
    }
     public function checkUserExist($username, $email)
    {
        $check = DB::table($this->table)
            ->where('username', $username)
            ->orWhere('email', $email)
            ->exists();

        return $check;
    }
    // ktra ng dung ton tai = token
    public function getUserByToken($token)
    {
        return DB::table($this->table)->where('activation_token', $token)->first();
    }
    // cap nhat trang thai tai khoan
    public function activateUserAccount($token)
    {
        return DB::table($this->table)
            ->where('activation_token', $token)
            ->update(['activation_token' => null,'isActive' => 'y']);
    }
    // login
    public function login($account)
    {
        $getUser = DB::table($this->table)
            ->where(function ($query) use ($account) {
                $query->where('username', $account['username'])
                    ->orWhere('email', $account['username']); 
            })
            ->where('password', Bcrypt($account['password'])) 
            ->first();

        return $getUser;
    }

    // login gg
    public function checkUserExistGoogle($googleid)
    {
        $check = DB::table($this->table)
            ->where('googleid', $googleid)->first();

        return $check;
    }
}
