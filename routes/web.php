<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\HomeController;


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

Route::get('/', function () {
    return view('welcome');
});



Route::group(['prefix' => 'admin'], function(){

        Route::group(['middleware' => 'admin.guest'],function(){

            Route::get('/login',[AdminLoginController::class,'index'])->name('admin.login');
            Route::post('/authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');
        });

        Route::group(['middleware' => 'admin.auth'],function(){
            Route::get('/dashboard',[HomeController::class,'index'])->name('admin.dashboard');
        });
});