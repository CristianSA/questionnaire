<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Project\ProjectController;

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

