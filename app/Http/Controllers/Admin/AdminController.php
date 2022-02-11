<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function dashboard()
    {
        return view('admin.dashboard.index');
    }

    public function logoutAdmin(Request $request)
    {
        Auth::guard('admin')->logout();

        Session::flush();

        $request->session()->flush();

        $request->session()->regenerate();


        return redirect()->guest(route('admin login'));

    }
}
