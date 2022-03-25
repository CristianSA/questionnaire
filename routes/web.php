<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\StudentAuthController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\Student\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//GUEST
Route::get('/', [GuestController::class, 'guest'])->name('index guest');
Auth::routes();

//ADMIN
Route::prefix('administrator')->group(function(){
    Route::controller(AdminAuthController::class)->group(function(){
        Route::get('/login', 'showAdminLoginForm')->name('admin login');
        Route::post('/login/validate', 'loginValidate')->name('admin validate');
    });

    Route::controller(AdminController::class)->group(function(){
        Route::get('/dashboard', 'dashboard')->name('admin dashboard');
        Route::post('/logout', 'logoutAdmin')->name('admin logout');
    });

    Route::controller(ProjectController::class)->group(function(){
        Route::get('/projects', 'index')->name('admin projects');
    });
});

//User
Route::controller(StudentAuthController::class)->group(function(){
    Route::post('/login/validate', 'loginValidate')->name('student validate');
    Route::get('/register/{project}', 'register')->name('student register');
    Route::post('/register/validate/{project}', 'registerValidate')->name('student register-validate');
});

Route::controller(StudentController::class)->group(function(){
    Route::get('/dashboard', 'dashboard')->name('student dashboard');
    Route::get('/my-projects', 'projects')->name('student projects');
    Route::get('/my-results', 'results')->name('student results');
    Route::get('/modules/{project}', 'modules')->name('student modules');
    Route::get('/module/{module}', 'module')->name('student module');
    Route::get('/module/questions/{module}', 'questions')->name('student questions');
    Route::get('/module/questions/results/{module}', 'result')->name('student result');
    Route::post('/logout', 'logoutStudent')->name('student logout');
});


