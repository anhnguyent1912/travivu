<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Authenticatable
{
    protected $table = 'tbl_admin';
    protected $primaryKey = 'adminid';
    public $timestamps = false;
    protected $authPasswordName = 'passWord';
    protected $hidden = [
        'passWord',
    ];
}
