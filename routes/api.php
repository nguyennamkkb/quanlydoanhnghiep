<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\CodeController;
use App\Http\Controllers\Api\UserApiController;
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
// Route::post('test', [TestController::class, 'Test']);


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LoginController::class, 'logout']);
    Route::get('user', [UserController::class, 'current']);
    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);

    Route::get('codes', [CodeController::class, 'index']); // lay thong toan bo thong tin
    Route::post('codes', [CodeController::class, 'store']); // them moi thong tin
    Route::get('codes/{id}', [CodeController::class, 'show']); // lay thong tin cuar 1 ma
    Route::put('codes/{id}', [CodeController::class, 'update']); // sua thong tin
    Route::delete('codes/{id}', [CodeController::class, 'destroy']); // xoa thong tin
    //user
    Route::get('users', [UserApiController::class, 'index']); // lay thong toan bo thong tin
    Route::post('users', [UserApiController::class, 'store']); // them moi thong tin
    Route::put('users/{id}', [UserApiController::class, 'update']); // sua thong tin
    Route::delete('users/{id}', [UserApiController::class, 'destroy']); // xoa thong tin
    //supplier
    Route::get('suppliers', [SupplierController::class, 'index']); // lay thong toan bo thong tin
    Route::post('suppliers', [SupplierController::class, 'store']); // them moi thong tin
    Route::put('suppliers/{id}', [SupplierController::class, 'update']); // sua thong tin
    Route::delete('suppliers/{id}', [SupplierController::class, 'destroy']); // xoa thong tin

});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [UserApiController::class, 'store']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);

    Route::post('oauth/{driver}', [OAuthController::class, 'redirect']);
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleCallback'])->name('oauth.callback');
});
