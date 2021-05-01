<?php

use App\Http\Controllers\task\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('token', function (Request $request) {
    if(Auth::attempt($request->only('email', 'password'))){
        $user = Auth::user();
        return $user->api_token;
    } else {
        return 'not a valid username and password';
    }
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->get('/tasks', [TaskController::class, 'getAllTasks']);
Route::middleware('auth:api')->post('/tasks', [TaskController::class, 'CreateNewTask']);
Route::middleware('auth:api')->post('/tasks/{id}', [TaskController::class, 'updateTasksById']);
Route::middleware('auth:api')->delete('/tasks/{id}', [TaskController::class, 'deleteTaskById']);