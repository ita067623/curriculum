<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Like;
use App\User;
use App\Models\Userrequest;



class DisplayController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }




    // ゲストログインの処理

    public function guestLogin()
    {
        // // ゲスト用の固定ユーザーID（もしくは新規作成）
        $guestUser = \App\Models\User::firstOrCreate([
            'email' => 'guest@example.com',
        ], [
            'name' => 'Guest User',
            'password' => bcrypt('password'), // 仮のパスワード
            'role' => '1',
        ]);

        // ログイン処理
        Auth::login($guestUser);

        return redirect()->route('article.index');




    }

// 管理者ログインの処理
    public function admin()
    {
        return view('ownerpage');
    }



    // ログイン後の処理
    public function index()
    {
        // return view('main'); // 'main'は、resources/views/main.blade.phpに対応
        return view('main');
    }


    



// 検索機能
public function fill(Request $request)
{
    $articles = Article::query();

// キーワード検索
if ($request->filled('keyword')) {
    $articles->searchKeyword($request->input('keyword'));
}

// 最低金額フィルター
if ($request->filled('min_price')) {
    $articles->where('price', '>=', $request->input('min_price'));
}

// 最高金額フィルター
if ($request->filled('max_price')) {
    $articles->where('price', '<=', $request->input('max_price'));
}

$articles = $articles->get();

return view('articles.index', compact('articles'));
}
         
        


// マイページ機能
public function myPage()
{
    // 現在の認証ユーザーを取得
    $user = Auth::user();

   
    // 認証されていない場合の対処
    if (!$user) {
        return redirect('/login')->with('error', 'ログインしてください。');
    }

     // デバッグ用（変数の内容を出力して処理を停止）
    //  dd($user);
    
    // 必要に応じて記事データを取得（例）
    $article = Article::first();
    
    // ビューにデータを渡す
    return view('mypage', compact('user', 'article'));
}
        




        
// 依頼・受注状況確認
        public function situationconfirm(Request $request)
    {
        $user = Auth::user(); // 現在ログイン中のユーザーを取得

    // ユーザーが投稿した記事を取得
    $articles = Article::where('user_id', $user->id)->get(); 

    return view('situation_conf', compact('articles')); // ビューにデータを渡す
    }
  

    
// いいね機能
    public function like($articleId)
    {
        $article = Article::findOrFail($articleId);
        $user = auth()->user();
    
        $existingLike = Like::where('article_id', $articleId)
                            ->where('user_id', $user->id)
                            ->first();
    
        if (!$existingLike) {
            Like::create([
                'user_id' => $user->id,
                'article_id' => $articleId,
            ]);

             // ログにデータを記録
        \Log::info("User {$user->id} liked article {$articleId}");
        }
    
        return response()->json(['success' => true]);
    }
    
    public function unlike($articleId)
    {
        $article = Article::findOrFail($articleId);
        $user = auth()->user();
    
        $existingLike = Like::where('article_id', $articleId)
                            ->where('user_id', $user->id)
                            ->first();
    
        if ($existingLike) {
            $existingLike->delete();
        }
    
        return response()->json(['success' => true]);
    }

    


// いいね一覧機能

public function nice()
{ 
    // likesテーブルからarticle_idを取得
    $likes = Like::select('article_id') // article_idのみを選択
                ->paginate(8); // ページネーションを使用

    // ビューにデータを渡す
    return view('nice', compact('likes'));

}


// 依頼関連
public function request($id)
{

    $article = Article::find($id);



    // もし $article が見つからない場合、適切なエラーハンドリングを行う
    if (!$article) {
        abort(404); // 記事が見つからなければ404エラーを返す
    }

    // $article をビューに渡す
    return view('request', compact('article'));
   
}


    public function confirm(Request $request)
    {
        // 入力データを一時的にセッションに保存する
        $article = Article::find($request->article_id); // 例として記事のIDを取得

    //      // 送信されたデータをデバッグ
    // dd($request->all()); // 送信されているすべてのデータを確認
      // 入力データを一時的にセッションに保存する
    //   dd($request->article_id); // ここでarticle_idが送信されているか確認

        // return view('request_conf', [
        //     'title' => $article->title, 
        //     'price' => $article->price, 
        //     'article' => $article,
        //     'deadline' => $request->deadline,
        //     'phone' => $request->phone,
        //     'email' => $request->email,
        //     'content' => $request->content
        // ]);

        //  フォームから送信されたタイトルと価格を受け取る
    $title = $request->title;
    $price = $request->price;

    // その他のフォームデータ
    $deadline = $request->deadline;
    $phone = $request->phone;
    $email = $request->email;
    $content = $request->content;

    return view('request_conf', compact('article','title', 'price', 'deadline', 'phone', 'email', 'content'));

        
    }

    public function submit(Request $request)
{
    // バリデーション
    $validated = $request->validate([
        'deadline' => 'required|date',
        'phone' => 'required|regex:/^[0-9]{10,11}$/',
        'email' => 'required|email',
        'content' => 'required|string|max:500',
    ]);

    // 保存処理
    $requestContent = new RequestContent();
    $requestContent->post_id = $request->article_id; // 記事のID
    $requestContent->user_id = auth()->id(); 
    $requestContent->content = $request->content;
    $requestContent->phone_number = $request->phone;
    $requestContent->email = $request->email;
    $requestContent->date = $request->deadline;
    $requestContent->save();

    // 完了ページやリダイレクト先に進む
    return redirect()->route('situation_conf')->with('success', '依頼が送信されました');
    
} 

public function situationConf()
{
    return view('situation_conf');
}


// 報告
public function report(Request $request){

 // URLのクエリパラメータからidを取得
 $id = $request->query('id');

 // 記事を取得
 $article = Article::find($id);

 // 記事が存在しない場合の処理
 if (!$article) {
     return redirect()->back()->withErrors(['記事が見つかりません。']);
 }

 $user = Auth::user();

 // セッションにデータを保存
 session(['article' => $article, 'user' => $user]);

 // ビューに渡す
 return view('report', ['article' => $article, 'user' => $user]);

}

public function reportstore(Request $request)
    {
    // 指定された記事をEager Loadingで取得
     // 記事と関連するユーザーデータをまとめて取得（N+1問題を回避）、関連するユーザーデータをロード
    //   $article = Article::with('user')->find($request->post_id);
    // $article = session('article');
    // $user = session('user');

    // $user = Auth::user(); 

    // $id = $request->query('id'); // クエリパラメータから id を取得
    $article = $request->input('post_id');
    
    // $article = Article::find($id);


    
    if (!$article) {
        return redirect()->back()->withErrors(['記事が見つかりません。']);
    }

    //     // 非同期キューで登録処理をディスパッチ
    // dispatch(new ReportJob([
    //     'user_id' => $user->id,
    //     'post_id' => $request->post_id,
    //     'reason' => $request->reason,
    // ]));

    // リクエスト全体を確認する
    // dd($request->all());

    $request->validate([
        'reason' => 'required|string|max:500',
        'post_id' => 'required|exists:articles,id',
        'user_id' => 'required|exists:users,id',
    ]);
    

    // データ保存
    Report::create([
        'user_id' => $request->user_id,
        'post_id' => $request->post_id,
        'reason' => $request->reason,
    ]);

    //  return response()->json([
    //      'user_id' => $user->id, 
    //      'post_id' => $request->post_id, // ユーザー名を取得
    //      'reason' => $request->reason,
    //  ]);

    //     return redirect()->route('/')->with('success', '報告が送信されました。');
    // }

    return redirect()->route('home')->with('success', '報告が送信されました。');
}



}



    // user詳細
    // public function user($id)
    // {
    //     // ユーザー詳細情報を取得
    //     $user = User::findOrFail($id); // IDが存在しない場合は404エラー

    //     return view('user.detail', compact('user'));

    // }
    // public function edit()
    //     {
    //         $user = auth()->user(); // ログイン中のユーザー情報を取得
    //         return view('user.edit', compact('user'));
    //     }
    
    //     public function editConfirm(Request $request)
    //     {
    //         $validated = $request->validate([
    //             'icon' => 'nullable|image|max:2048',
    //             'name' => 'required|string|max:255',
    //             'email' => 'required|email|max:255',
    //             'details' => 'nullable|string|max:500',
    //         ]);


    //          // アイコン画像がアップロードされている場合、一時保存する
    //     if ($request->hasFile('icon')) {
    //         $validated['icon'] = $request->file('icon')->store('temp', 'public');
    //     } else {
    //         $validated['icon'] = auth()->user()->icon; // 現在の画像を使用
    //     }

    //     return view('user.edit_confirm', ['data' => $validated]);
    // }

    // public function update(Request $request)
    // {
    //     $user = auth()->user();
    //     $data = $request->only(['name', 'email', 'details']);

    //     // アイコン画像の保存
    //     if ($request->hasFile('icon')) {
    //         $data['icon'] = $request->file('icon')->store('icons', 'public');
    //     }

    //     $user->update($data);

    //     return redirect()->route('user.edit')->with('success', 'アカウント情報を更新しました。');
    // }



//   退会関連
    // public function deleteConfirm()
    // {
    //     return view('user.delete_confirm');
    // }

    // public function delete(Request $request)
    // {
    //     $user = Auth::user();

    //     // 関連するデータも削除する（必要に応じて）
    //     // 例: $user->posts()->delete();

    //     $user->delete(); // ユーザーの削除

    //     Auth::logout(); // ログアウト
    //     return redirect()->route('home')->with('success', 'アカウントを削除しました。');
    // }

    // // 依頼受注確認
    //     public function confirm()
    //     {
    //         $requests = [
    //             (object)['image_url' => 'path/to/request1.jpg', 'title' => '依頼1'],
    //             (object)['image_url' => 'path/to/request2.jpg', 'title' => '依頼2'],
    //             (object)['image_url' => 'path/to/request3.jpg', 'title' => '依頼3'],
    //         ];
    
    //         $projects = [
    //             (object)['image_url' => 'path/to/project1.jpg', 'title' => '案件1'],
    //             (object)['image_url' => 'path/to/project2.jpg', 'title' => '案件2'],
    //             (object)['image_url' => 'path/to/project3.jpg', 'title' => '案件3'],
    //         ];
    
    //         return view('situation.confirm', compact('requests', 'projects'));
    //     }
    
    