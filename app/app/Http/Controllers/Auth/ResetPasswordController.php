<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
// 追加
// use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{ 
    // 追加
    //  use SendsPasswordResetEmails; 



    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    // use ResetsPasswords;


    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


// 追加
    // public function showLinkRequestForm()
    // {
    //     // パスワードリセットフォームを表示
    //     return view('auth.passwords.email');
    // }
} 
