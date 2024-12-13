<?php

use App\Http\controllers\DisplayController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;




Auth::routes();

// 未登録ユーザーの制限（例: 特定ページへのアクセス制限）
    // Route::get('/guest-login', [DisplayController::class,'guest'])->name('guest.dashboard');
    Route::get('/guest-login', function () {
        $guestId = 4; // ゲストユーザーのID
        Auth::loginUsingId($guestId); // ゲストユーザーでログイン
        return redirect('/unregistered'); // ログイン後のリダイレクト先
    })->name('guest.login');

    Route::middleware(['role:1'])->get('/unregistered', function () {
        return view('unregistered'); // unregistered.blade.phpを表示
    });
    
    // Route::middleware(['role:1'])->group(function () {
    //     Route::get('/unregistered', function () {
    //         return 'このページはRole 1のユーザー専用です。';




// ログイン機能
// // Route::middleware(['auth'])->group(function () {
//     // 管理者専用ルート
//     Route::middleware(['role:0'])->group(function () {
//         Route::get('/admin', [DisplayController::class, 'admin'])->name('admin.dashboard');
//     });
// Route::get('/host-login', function () {
//     $guestId = 3;
//     Auth::loginUsingId($hostId);
//     return redirect('/ownerpage');
// })->name('host.login');
// Route::middleware(['role:0'])->get('/ownerpage', function () {
//     return view('ownerpage'); 
// });


    // // 通常登録ユーザー専用ルート
    // Route::middleware(['role:2'])->group(function () {
    //     Route::get('/user', [DisplayController::class, 'index'])->name('user.dashboard');
    // });
// });


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


// 検索機能
Route::get('fill', [DisplayController::class, 'fill'])->name('fill');



// 依頼関連
Route::get('/request/{id}', [DisplayController::class, 'request'])->name('request');
Route::post('/request/confirm', [DisplayController::class, 'confirm'])->name('request.confirm');
Route::post('/request/submit', [DisplayController::class, 'submit'])->name('request.submit');
Route::get('/situation_conf', [DisplayController::class, 'situationConf'])->name('situation_conf');

// 管理者関連
Route::get('report', [DisplayController::class, 'report'])->name('report');
});
Route::post('/reports', [DisplayController::class, 'reportstore'])->name('reports.store');



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





