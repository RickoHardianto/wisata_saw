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


Route::post('/login', 'App\Http\Controllers\Api\AuthController@login');
Route::post('/register', 'App\Http\Controllers\Api\AuthController@register');
Route::get('/logout', 'App\Http\Controllers\Api\AuthController@logout');

Route::resource('/business', App\Http\Controllers\Api\BusinessController::class);
Route::resource('/categories', App\Http\Controllers\Api\CategoryController::class);
Route::resource('/regions', App\Http\Controllers\Api\RegionController::class);
Route::resource('/destination', App\Http\Controllers\Api\DestinationController::class);
Route::resource('/kelola-wisata', App\Http\Controllers\Api\KelolaDestinasiController::class);
Route::resource('/roles', App\Http\Controllers\Api\RoleController::class);
Route::resource('users', App\Http\Controllers\Api\UserController::class);


Route::get('/saw', [App\Http\Controllers\Api\DestinationController::class, 'calculateSAW']);
Route::get('/dashboard', [App\Http\Controllers\Api\DashboardController::class, 'index']);


Route::resource('/kriteria', App\Http\Controllers\Api\KriteriaController::class);
// Route::get('/hitung', [App\Http\Controllers\Api\HitungController::class, 'hitung'])->name('hitung');

Route::patch('/destination/{destination}/status', [App\Http\Controllers\Api\DestinationController::class, 'updateStatus']);
Route::post('/reviews', [App\Http\Controllers\Api\ReviewController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/destination', [App\Http\Controllers\Api\DestinationController::class, 'store']);
    Route::get('/kelola-wisata', [App\Http\Controllers\Api\KelolaDestinasiController::class, 'index']);
    Route::post('/kelola-wisata', [App\Http\Controllers\Api\KelolaDestinasiController::class, 'store']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('users', App\Http\Controllers\Api\UserController::class);
//     Route::apiResource('roles',App\Http\Controllers\Api\RoleController::class);
// });
