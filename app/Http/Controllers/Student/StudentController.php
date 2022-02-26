<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('student');
    }

    public function dashboard()
    {
        return view('student.dashboard.index');
    }

    public function register()
    {
        return view('student.register.index');
    }


    public function logout()
    {
        Auth::guard('student')->logout();

        Session::flush();

        $request->session()->flush();

        $request->session()->regenerate();


        return redirect()->guest(route('student login'));
    }
}
