<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
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

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}





// <?php

// namespace App\Http\Controllers\Auth;

// use App\Http\Controllers\Controller;
// use App\Providers\RouteServiceProvider;
// use Illuminate\Foundation\Auth\ResetsPasswords;


// // 追加

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Password;


// class ResetPasswordController extends Controller
// { 
//     // 追加
//     //  use SendsPasswordResetEmails; 



//     /*
//     |--------------------------------------------------------------------------
//     | Password Reset Controller
//     |--------------------------------------------------------------------------
//     |
//     | This controller is responsible for handling password reset requests
//     | and uses a simple trait to include this behavior. You're free to
//     | explore this trait and override any methods you wish to tweak.
//     |
//     */

//     // use ResetsPasswords;


//     /**
//      * Where to redirect users after resetting their password.
//      *
//      * @var string
//      */
//     protected $redirectTo = RouteServiceProvider::HOME;


// // 追加
//  // パスワードリセットフォームの表示
// //  public function showResetForm(Request $request, $token = null)
// //  {
// //      return view('auth.passwords.reset')->with(
// //          ['token' => $token, 'email' => $request->email]
// //      );
// //  }

// //  // パスワードのリセット処理
// //  public function reset(Request $request)
// //  {
// //      $this->validate($request, [
// //          'email' => 'required|email',
// //          'password' => 'required|confirmed|min:6',
// //      ]);

// //      $response = Password::reset(
// //          $request->only('email', 'password', 'password_confirmation', 'token'),
// //          function ($user, $password) {
// //              $user->password = bcrypt($password);
// //              $user->save();
// //          }
// //      );

// //      return $response == Password::PASSWORD_RESET
// //                  ? redirect()->route('login')->with('status', 'Password has been reset!')
// //                  : back()->withErrors(['email' => [trans($response)]]);
// //  }
// }

