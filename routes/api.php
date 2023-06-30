<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MyExersiseController;
use App\Http\Controllers\MyDiaryController;
use App\Http\Controllers\MealHistoryController;
use App\Http\Controllers\MyRecordController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/change-pass', [AuthController::class, 'changePassWord']);

    //exsersise

    Route::get('/exersise/get-my-exersise', [MyExersiseController::class, 'index']);
    Route::post('/exersise/store', [MyExersiseController::class, 'store']);


    Route::get('/diary/get-my-diary', [MyDiaryController::class, 'index']);
    Route::post('/diary/store', [MyDiaryController::class, 'store']);


    Route::get('/record/get-my-record', [MyRecordController::class, 'index']);
    Route::get('/record/get-my-record-graph', [MyRecordController::class, 'getMyRecordGraph']);
    Route::post('/record/store', [MyRecordController::class, 'store']);


    Route::get('/meal-history/get-meal-history', [MealHistoryController::class, 'index']);
});



Route::group(['namespace' => 'App\Http\Controllers'], function()
{


    Route::group(['middleware' => ['guest']], function() {
        Route::get('/get-recommendation', 'PostController@getRecommendation');

    });

});
