<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Projects\ProjectController;
use App\Http\Controllers\Api\Students\StudentController;
use App\Http\Controllers\Api\Images\ImageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
Route::controller(ProjectController::class)->group(function(){
    Route::get('/projects', 'projects');
    Route::post('/project', 'store');
    Route::put('/project/{project}', 'update');
    Route::delete('/project/{project}', 'destroy');
    Route::get('/{project}/analytics', 'analytics');
});
//MULTIMEDIA
Route::controller(ImageController::class)->group(function(){
    Route::post('/image', 'store');
    Route::put('/image/{image}', 'update');
    Route::delete('/image/{image}', 'delete');
    Route::get('/projects/image/{project}', 'imageProject');
});
//STUDENTS
Route::controller(StudentController::class)->group(function(){
    Route::get('/projects-by-student/{student}', 'projectsByStudent');
    Route::get('/modules-by-project/{project}', 'modulesByProjects');
    Route::get('/attempts-by-student/{student}', 'attemptsByStudent');
    Route::post('/answer-question', 'answerQuestion');
    Route::get('/testing', 'testing');
    Route::get('/{student}/project-results', 'studentProjectResults');
});
