<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;


// 追加
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{


    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;




// 追加
     /**
     * Where to redirect users after password reset link is sent.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showLinkRequestForm()
    {
        // リセットリンクの送信フォームを表示し、必要な変数を渡す
        $url = route('password.reset', ['token' => 'example-token']); // 仮のトークン
        return view('auth.passwords.email', compact('url'));
    }
}
