<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        
    }




// tuika ログインの処理
    public function login(Request $request)
    {
        // バリデーション
        $credentials = $request->only('email', 'password');

        // 認証処理
        if (Auth::attempt($credentials)) {
            // 認証成功後にリダイレクト
            return redirect()->route('main');
        } else {
            // 認証失敗時の処理
            return redirect()->back()->withErrors(['email' => 'メールアドレスまたはパスワードが間違っています。']);
        }
    }







// tuika  uthenticatedメソッド
    public function authenticated(Request $request, $user)
{
    // return redirect()->route('main');
    return view('main');
}
}
