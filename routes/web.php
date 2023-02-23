<?php

use App\Http\Controllers\Manage\CategoryController;
use App\Http\Controllers\Manage\ClientController;
use App\Http\Controllers\Manage\ProductController;
use App\Http\Controllers\Manage\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'manage', 'middleware' => 'auth:admin', 'as' => 'manage.'], function() {
    Route::resource('products', ProductController::class);

    Route::resource('categories', CategoryController::class);
    Route::resource('clients', ClientController::class);
    Route::post('clients/refresh-token/{client}', [ClientController::class, 'refreshToken'])->name('clients.refresh_token');

    Route::resource('users', UserController::class);
});
