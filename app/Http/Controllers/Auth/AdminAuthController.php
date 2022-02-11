<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Admins\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
        
    }

    public function showAdminLoginForm(Request $request)
    {
        //$admin = new Admin;
        //$admin->name = "Sr.Cristian";
        //$admin->email = "admin@admin.com";
        //$admin->password = Hash::make('admin12345');
        //$admin->save();
        return view('admin.auth.index');
    }

    public function loginValidate(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('administrator/dashboard');
        }

        return back()->withInput($request->only('email', 'remember'));
    }

    
}
