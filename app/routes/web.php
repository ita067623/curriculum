<?php

use App\Http\controllers\DisplayController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::group(['middleware'=>'auth'],function(){

Route::get('/',[DisplayController::class,'index']);

// Route::get('/main', [RegisterController::class, 'index'])->name('main');
// Route::get('/main', [LoginController::class, 'index'])->name('main');
// LoginControllerの中で/mainへのリダイレクトを管理するため、Route::get('/main')のルート削除し、authenticatedメソッドでのリダイレクト

    Route::get('/main', [DisplayController::class, 'index'])->name('main');
});
