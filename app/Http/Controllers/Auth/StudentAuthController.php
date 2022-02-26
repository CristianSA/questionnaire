<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project\Password;
use App\Models\Project\Project;
use App\Models\Student\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:student');
        
    }

    public function loginValidate(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);
        
        if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/dashboard');
        }
        //buscar clave correspondiente del proyecto
        $password_project = Password::byPassword($request->password)->get()->first();
        $project = $password_project ? $password_project->project : null;
        //dd($project);
        if($project && $project->it_is_accesible && $project->is_active && !$project->userRegisteredInProject($request->email))
            return redirect()->route('student register', ['project' => $project]);
        
        return back()->withInput($request->only('email', 'remember'));
    }

    public function register(Project $project)
    {
        return view('student.register.index', compact('project'));
    }

    public function registerValidate(Project $project, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'nickname' => 'required|unique:students,nickname',
            'email' => 'required|email|unique:students,email',
            'password' => 'required',
        ]);

        if($validated){
            $student = new Student();
            $student->name                  = $request->name;
            $student->nickname              = $request->nickname;
            $student->email                 = $request->email;
            $student->password              = Hash::make($request->password);
            $student->save();

            $project->students()->sync([$student->id]);

            if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                return redirect()->intended('/dashboard');
            }

        }
    }
}
