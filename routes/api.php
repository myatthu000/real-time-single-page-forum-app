<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ReplyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/question',QuestionController::class);
Route::apiResource("/category", CategoryController::class);
Route::apiResource("/question/{question}/reply", ReplyController::class);


Route::post('/like/{reply}', [LikeController::class,'likeIt']);
Route::delete('/like/{reply}', [LikeController::class,'unlikeIt']);

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', [AuthController::class,'login']);
    Route::post('signUp', [AuthController::class,'signUp']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

});
