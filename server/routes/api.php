<?php

use App\Http\Controllers\Api\RoleController;
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


Route::post('/login', 'App\Http\Controllers\Api\LoginController@index');
Route::get('/logout', 'App\Http\Controllers\Api\LoginController@logout');

Route::resource('/business', App\Http\Controllers\Api\BusinessController::class);
Route::resource('/categories', App\Http\Controllers\Api\CategoryController::class);
Route::resource('/regions', App\Http\Controllers\Api\RegionController::class);
Route::resource('/destination', App\Http\Controllers\Api\DestinationController::class);
Route::resource('/roles',App\Http\Controllers\Api\RoleController::class);

Route::patch('/destination/{destination}/status', [App\Http\Controllers\Api\DestinationController::class, 'updateStatus']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
 });

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('users',App\Http\Controllers\Api\UserController::class);
    // Route::apiResource('roles',App\Http\Controllers\Api\RoleController::class);
 });
