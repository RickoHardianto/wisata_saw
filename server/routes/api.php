<?php

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

Route::apiResource('/business', App\Http\Controllers\Api\BusinessController::class);
Route::apiResource('/categories', App\Http\Controllers\Api\CategoryController::class);
Route::apiResource('/regions', App\Http\Controllers\Api\RegionController::class);
Route::apiResource('/destination', App\Http\Controllers\Api\DestinationController::class);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
