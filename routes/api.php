<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CodeController;
use App\Http\Controllers\Api\UseroController;
use App\Http\Controllers\Api\SupplierController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//codeController
Route::get('codes',[ CodeController::class, 'index']);// lay thong toan bo thong tin
Route::post('codes',[ CodeController::class, 'store']); // them moi thong tin
Route::get('codes/{id}',[ CodeController::class, 'show']);// lay thong tin cuar 1 ma
Route::put('codes/{id}',[ CodeController::class, 'update']); // sua thong tin
Route::delete('codes/{id}',[ CodeController::class, 'destroy']);// xoa thong tin
//user
Route::get('users',[ UseroController::class, 'index']);// lay thong toan bo thong tin
Route::post('users',[ UseroController::class, 'store']); // them moi thong tin
Route::put('users/{id}',[ UseroController::class, 'update']); // sua thong tin
Route::delete('users/{id}',[ UseroController::class, 'destroy']);// xoa thong tin
//supplier
Route::get('suppliers',[ SupplierController::class, 'index']);// lay thong toan bo thong tin
Route::post('suppliers',[ SupplierController::class, 'store']); // them moi thong tin
Route::put('suppliers/{id}',[ SupplierController::class, 'update']); // sua thong tin
Route::delete('suppliers/{id}',[ SupplierController::class, 'destroy']);// xoa thong tin