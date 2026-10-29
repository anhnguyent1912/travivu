<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index()
    {
        $title = 'Thông tin cá nhân';
        return view('clients.infor', compact('title'));
    }
}
