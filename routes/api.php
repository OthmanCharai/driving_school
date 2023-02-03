<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', static function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class,"login"])->name('login');
Route::post('logout', [AuthController::class,"logout"]);
Route::post('refresh', [AuthController::class,"refresh"]);
Route::post('register', [AuthController::class,'register']);

Route::middleware(['jwt.verify'])->group(static function (){

    Route::apiResource('user', App\Http\Controllers\Api\UserController::class);

    Route::apiResource('exam', App\Http\Controllers\Api\ExamController::class);

    Route::apiResource('sub-exam', App\Http\Controllers\Api\SubExamController::class);

    Route::apiResource('question', App\Http\Controllers\Api\QuestionController::class);

    Route::apiResource('option', App\Http\Controllers\Api\OptionController::class);
});







