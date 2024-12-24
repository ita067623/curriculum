<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// 追加
use Illuminate\Http\Request; 

class RegisterController extends Controller
 { 
   

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
     $this->middleware('guest');
          // ユーザー登録後、ログインをした状態にして、完了画面を表示するため、completeではguestミドルウェアを無効にする
        //   $this->middleware('guest', ['except' => 'complete']);


        
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        //  変更
         return Validator::make($data, [
             'name' => ['required', 'string', 'min:2', 'max:16', 'unique:users'],
             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
             'password' => ['required', 'string', 'min:8', 'max:16'],
         ],[
            'name.required' => '名前は必須です。',
            'name.min' => '名前は2文字以上で入力してください。',
            'name.max' => '名前は16文字以内で入力してください。',
            'name.unique' => 'この名前はすでに使用されています。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '正しいメールアドレスの形式で入力してください。',
            'email.unique' => 'メールアドレスは既に存在しています。',
            'password.required' => 'パスワードは必須です。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.max' => 'パスワードは16文字以内で入力してください。',
        ]);
         
         
         
         
         
         
            
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * 入力画面を表示
     */
//     public function register()
//     {
//         return view('auth.register');
//     }

//     /**
//      * 確認画面を表示
//      */
//     public function confirm(Request $request)
//     {
//         // バリデーションの処理
//         $validatedData = $request->validate([
//             'name' => 'required|string|min:2|max:16|unique:users',
//             'email' => 'required|email|max:255|unique:users',
//             'password' => 'required|string|min:8|max:16',
//         ]);

//         dd($validatedData); // バリデーション後のデータを確認


//         // password非表示
//         $validatedData['password']='********';
        
//         $request->session()->put('register',$validatedData);

//         // 登録確認画面にリダイレクト
//         return  view('signup_conf',['data' =>$validatedData]);
//     }

    

//     public function store(Request $request)
//     {
//     $data = $request->session()->get('register');

//     // 実際にデータベースに保存する際はパスワードをハッシュ化
//     User::create([
//         'name' => $data['name'],
//         'email' => $data['email'],
//         'password' => Hash::make($request->session()->get('register_original_password')),
//     ]);

//     // セッションデータを削除
//     $request->session()->forget('register');

//     return redirect()->route('register.complete');
// }

// public function complete()
// {
//     return view('signup_comp');
// }

//  /**
//      * Create a new user instance after a valid registration.
//      *
//      * @param  array  $data
//      * @return \App\User
//      */
//     protected function create(array $data)
//     {
//         return User::create([
//             'name' => $data['name'],
//             'email' => $data['email'],
//             'password' => Hash::make($data['password']),
//         ]);
//     }

}