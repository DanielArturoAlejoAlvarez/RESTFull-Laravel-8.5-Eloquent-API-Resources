<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PostController;

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

Route::get('/', [App\Http\Controllers\PageController::class, 'index'])->name('welcome');

Route::group(['prefix' => 'api'], function () {
    Route::apiResource('posts', PostController::class);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\Backend\HomeController::class, 'index'])->name('home');
