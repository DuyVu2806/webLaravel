<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function logout()
    {
        Auth::guard()->logout();
        return redirect()->route('login')->with('success','Đăng xuất thành công');
    }

}
