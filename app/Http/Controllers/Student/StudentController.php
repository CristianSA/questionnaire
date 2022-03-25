<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Project\Project;
use App\Models\Project\Module\Module;

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


    public function logoutStudent(Request $request)
    {
        Auth::guard('student')->logout();

        Session::flush();

        $request->session()->flush();

        $request->session()->regenerate();


        return redirect()->guest(route('index guest'));
    }

    public function projects()
    {
        return view('student.projects.index');
    }

    public function modules(Project $project)
    {
        return view('student.projects.modules.index', compact('project'));
    }

    public function module(Module $module)
    {
        return view('student.projects.modules.module', compact('module'));
    }

    public function questions(Module $module)
    {
        $questions = $module->questions;
        return view('student.projects.modules.questions.index', compact('questions', 'module'));
    }

    public function results()
    {
        return view('student.results.index');
    }

    public function result(Module $module)
    {
        return view('student.projects.modules.questions.results', compact('module'));
    }
}
