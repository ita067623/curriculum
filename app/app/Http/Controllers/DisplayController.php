<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Like;
use App\User;



class DisplayController extends Controller
{
    // ログイン後の処理
    public function index()
    {
        // return view('main'); // 'main'は、resources/views/main.blade.phpに対応
        return view('main');
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
        // return view('mypage'); // mypage.blade.phpを表示
        
        // // ログインユーザーを取得
        // $user = Auth::user();

        // // mypageビューにデータを渡す
        // return view('mypage', compact('user'));




        
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






    // 依頼関連
    // public function input()
    // {
    //     return view('request.input');
    // }



    //     public function confirm(Request $request)
    //     {
    //         $validated = $request->validate([
    //             'title' => 'required|string|max:255',
    //             'amount' => 'required|numeric',
    //             'deadline' => 'required|date',
    //             'phone' => 'required|string',
    //             'email' => 'required|email',
    //             'details' => 'required|string',
    //         ]);
    
    //         return view('request.confirm', ['data' => $validated]);
    //     }
    
    //     public function complete()
    //     {
    //         // 確定処理を実装
    //         return redirect()->route('home')->with('status', '依頼が確定しました！');
    //     }
    




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
    
    