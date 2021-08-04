<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

<<<<<<< HEAD

Route::any('/dashboard/{slug}', function(){ // dashboard app trang quanr tri
    return view('welcome');
});
=======
Route::any('{all}', function () {
    return view('app');
})
->where(['all' => '.*']);
>>>>>>> 3d34eaace4f7f850f4b3a2bf7f0e1d2b0a506f91
