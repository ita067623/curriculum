<?php

use App\Http\controllers\DisplayController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;




Auth::routes();
Route::group(['middleware'=>'auth'],function(){


// // リソースコントローラ
Route::get('/', 'ArticleController@index')->name('articles.index'); // ここを追記

Route::resource('articles', 'ArticleController')->except('index'); // ここを編集

// // 案件依頼確認
Route::get('situation_conf', [DisplayController::class, 'situationconfirm'])->name('situation.confirm');

// マイページ関連
    Route::get('/mypage', [DisplayController::class, 'myPage'])->name('mypage');

// いいね
Route::get('nice', [DisplayController::class, 'nice'])->name('nice');
Route::post('/post/{article}/like', [DisplayController::class, 'like'])->name('like');
Route::delete('/post/{article}/like', [DisplayController::class, 'unlike'])->name('unlike');

// rogin関連
// Route::get('register', 'Auth\RegisterController@register')->name('register'); // 入力画面
// Route::post('register/confirm', 'Auth\RegisterController@confirm')->name('register.confirm'); // 確認画面
// Route::post('register', 'Auth\RegisterController@store')->name('register.store'); // 登録処理
// Route::get('register/complete', 'Auth\RegisterController@complete')->name('register.complete'); // 完了画面
// Route::get('/main', [RegisterController::class, 'index'])->name('main');



// ユーザー関連
// Route::get('/user/{id}', [DisplayController::class, 'show'])->name('user.detail');
// Route::get('/user/edit', [DisplayController::class, 'edit'])->name('user.edit');
// Route::post('/user/edit/confirm', [DisplayController::class, 'editConfirm'])->name('user.edit.confirm');
// Route::post('/user/update', [DisplayController::class, 'update'])->name('user.update');

// Route::get('/user/delete/confirm', [DisplayController::class, 'deleteConfirm'])->name('user.delete.confirm');
// Route::post('/user/delete', [DisplayController::class, 'delete'])->name('user.delete');



// 依頼関連
// Route::get('/request', [DisplayController::class, 'input'])->name('request.input');
// Route::post('/request/confirm', [DisplayController::class, 'confirm'])->name('request.confirm');
// Route::post('/request/complete', [DisplayController::class, 'complete'])->name('request.complete');




});