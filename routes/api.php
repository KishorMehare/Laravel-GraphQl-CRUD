<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('/receive',\App\Http\Controllers\Api\EventController::class);
Route::post('/activity-by-user', '\App\Http\Controllers\Api\EventController@StudentActivity');
Route::get('/longest-activity', '\App\Http\Controllers\Api\EventController@averageActivity');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
