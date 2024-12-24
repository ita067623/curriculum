<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Like;
use App\User;
use App\Models\Requested;
use App\Models\Report;
use App\Models\UserReport;
use Illuminate\Support\Facades\DB;



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







    // 管理者画面

    // オーナーページサーチの案件表示停止

    public function ownerindex(Request $request)
{
    $search = $request->input('search', '');
    $sort = $request->input('sort', 'id');

    // reportsテーブルのデータを検索・並び替えし、関連するユーザー情報も取得
    // $reports = Report::with('user', 'post.user') // user と post.user リレーションをロード
    $reports = Report::with('user', 'post') 
        ->select('reports.*', \DB::raw('(SELECT COUNT(*) FROM reports r WHERE r.post_id = reports.post_id) as reports_count')) // サブクエリで件数を計算
        ->when($search, function ($query, $search) {
            $query->where('reason', 'like', "%{$search}%");
        })
        ->orderBy($sort === 'reports_count' ? 'reports_count' : $sort, 'desc') // 並び替え条件
        ->paginate(20);

    // 同じ post_id ごとの報告回数をクエリで取得（ビューで利用する場合に保持）
    $postCounts = Report::select('post_id', \DB::raw('count(*) as count'))
        ->groupBy('post_id')
        ->pluck('count', 'post_id'); // post_idをキーにしてcountを取得

    return view('ownerpage_serch', compact('reports', 'search', 'sort', 'postCounts'));
}




// オーナーページサーチの投稿削除

public function upStatus(Request $request, $postId)
{
    // post_idに該当する投稿を取得
    $post = Article::findOrFail($postId);

    // フォームから送信されたstatusを設定
    $post->status = $request->input('status');
    
    // 保存
    $post->save();

    // リダイレクトまたはビューへ
    // return redirect()->route('owner_users.index')->with('success', '違反対応のステータスが更新されました');
    return redirect()->route('owner_users.index')->with('success', '違反対応のステータスが更新されました');
}


// ユーザー停止・削除　者　一覧


public function ownerpagedetail()
{
    // user_reportsテーブルからデータを取得
    $reports = UserReport::all();

    // 各ユーザーの名前をUserテーブルから取得
    foreach ($reports as $report) {
        // user_idを使ってUserテーブルから名前を取得
        $user = User::find($report->user_id);
        $report->user_name = $user ? $user->name : '不明';

        // 各ユーザーのArticleテーブルでステータスが削除または停止の件数を取得
        $report->article_count = Article::where('user_id', $report->user_id)
                                         ->whereIn('status', ['削除', '停止'])
                                         ->count();
    }

   // article_countの多い順に並べる
$sortedReports = $reports->sortByDesc('article_count');


return view('ownerpage_report2', ['reports' => $sortedReports]);
}




// 停止・削除　案件　一覧

public function suspendedOrDeletedUsers()
{
    // 停止・削除の状態を持つ記事をカウントして、ユーザーごとに集計
    $articles = Article::select('user_id', \DB::raw('COUNT(*) as count'))
        ->whereIn('status', ['停止', '削除'])  // statusが'停止'か'削除'のもの
        ->groupBy('user_id')  // user_idごとにグループ化
        ->orderByDesc('count')  // カウント数で降順ソート
        ->paginate(10);  // 10名ずつ表示

    return view('ownerpage_suspended_deleted_users', compact('articles'));
}
   






// アカウント削除ownerpage_serch2' view

public function suspend(Request $request)
{
    $search = $request->input('search', '');
    $sort = $request->input('sort', 'id');

    // reportsテーブルのデータを検索・並び替えし、関連するユーザー情報も取得
    $reports = Report::with('user', 'post') // user と post リレーションをロード
        ->select('reports.*', \DB::raw('(SELECT COUNT(*) FROM reports r WHERE r.post_id = reports.post_id) as reports_count')) // サブクエリで件数を計算
        ->when($search, function ($query, $search) {
            $query->where('reason', 'like', "%{$search}%");
        })
        ->orderBy($sort === 'reports_count' ? 'reports_count' : $sort, 'desc') // 並び替え条件
        ->paginate(20);

    // 同じ post_id ごとの報告回数をクエリで取得（ビューで利用する場合に保持）
    $postCounts = Report::select('post_id', \DB::raw('count(*) as count'))
        ->groupBy('post_id')
        ->pluck('count', 'post_id'); // post_idをキーにしてcountを取得

    // return view('ownerpage_serch2', compact('reports', 'search', 'sort', 'postCounts'));
    return view('ownerpage_serch2', compact('reports', 'search', 'sort', 'postCounts'));
    
}






// アカウント停止

// public function registerStatus(Request $request, $reportId)
// {
//     // リクエストからuser_idとstatusを取得
//     $userId = $request->input('user_id');
//     $status = $request->input('status', 'default'); // デフォルトステータスを指定

//     // user_reportテーブルに新しいレコードを挿入
//     $userReport = UserReport::create([
//         'user_id' => $userId,
//         'status' 
//     ]);

//     // 成功メッセージを追加してリダイレクト
//     return redirect()->route('ownerpage.suspend')->with('status', 'データが登録されました。');


// }



// public function registerStatus(Request $request, $reportId)
// {
//     // リクエストから user_id と status を取得
//     $userId = $request->input('user_id');
//     $status = $request->input('status', 'default'); // デフォルトステータスを指定

//     // トランザクション開始
//     DB::beginTransaction();

//     try {
//         // user_reports テーブルに新しいレコードを挿入
//         $userReport = UserReport::create([
//             'user_id' => $userId,
//             'status' => $status
//         ]);

//         // users テーブルの role カラムを更新
//         $user = User::findOrFail($userId); // user_id に該当するユーザーを取得
//         $user->role = 4; // role を 4 に更新
//         $user->save();

//         // トランザクションをコミット
//         DB::commit();

//         // 成功メッセージを追加してリダイレクト
//         return redirect()->route('ownerpage.suspend')->with('status', 'データが登録されました。');

//     } catch (\Exception $e) {
//         // エラー発生時にロールバック
//         DB::rollBack();

//         // エラーメッセージを返す
//         return redirect()->route('ownerpage.suspend')->with('error', 'データの登録に失敗しました: ' . $e->getMessage());
//     }
// }


// サーチ２　違反者停止
public function registerStatus(Request $request, $reportId)
{
    $userId = $request->input('user_id');
    $status = $request->input('status', 'default'); // デフォルトステータス

    DB::beginTransaction();

    try {
        \Log::info('処理開始', ['user_id' => $userId, 'status' => $status]);
        
        // user_reports テーブルにデータ登録
        $userReport = UserReport::create([
            'user_id' => $userId,
            'status' 
        ]);
        \Log::info('user_reports に登録成功', ['user_report_id' => $userReport->id]);

        // dd($request->all());

        // users テーブルの role を更新
        $user = User::findOrFail($userId);
        $user->role = 4;
        $user->save();
        \Log::info('users の role 更新成功', ['user_id' => $userId]);

        DB::commit();
        \Log::info('トランザクションコミット成功');

        return redirect()->route('ownerpage.suspend')->with('status', 'データが登録されました。');
    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('エラーが発生: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
        return redirect()->route('ownerpage.suspend')->with('error', 'データの登録に失敗しました: ' . $e->getMessage());
        // return redirect()-> view('ownerpage_serch2')->with('error', 'データの登録に失敗しました: ' . $e->getMessage());
    }
}




// アカウント削除ページ 12/24修正

// public function updateStatus(Request $request,$reportId)
// {

   
//     // Requestテーブルからデータを取得
//     $requestData = Report::find($reportId);

//     if (!$requestData) {
//         return redirect()->route('owner_users.index')->with('error', '報告が見つかりません。');
//     }

//      // Requestテーブルからuser_idを取得
//      $userId = $requestData->user_id;

    

//     //  // UserReportテーブルからuser_idに基づいてデータを取得
//     $report = UserReport::where('user_id', $userId)->first();

     

//      // UserReportデータが見つからない場合はエラーハンドリング
//      if (!$report) {
//         return redirect()->route('owner_users.index')->with('error', 'ユーザーレポートが見つかりません。');
//     }

//      // リクエストデータの取得
//      $status = $request->input('status');

//     //  // リクエストデータを確認する
//     //  dd(request()->all());  // リクエストデータ全体を確認








// // 状態が「停止」の場合
// if ($status === '停止') {
//     // UserReportのステータスを「停止」に変更
//     $this->updateUserReportStatus($report->user_id, '停止');

//     // 関連するユーザーのステータスを「停止」に変更
//     $user = $report->user; // 関連するユーザーを取得
//     if ($user) {
//         $user->status = '停止'; // ステータスを「停止」に変更
//         $user->role = 4;        // roleカラムを「4」に変更
//         $user->save();
//     }
// }





//     // 状態を「解決済み」にする場合
//     if ($status === '解決済み') {
//         // UserReportのステータスを更新
//         $this->updateUserReportStatus($report->user_id, $status);

//         // 報告の状態を更新
//         $report->status = $status;
//         $report->save();
//     }
//     // dd($request->all()); // リクエストデータをデバッグ


//     return redirect()->route('ownerpage.suspend')->with('status', 'ユーザーの状態が更新されました。');
// }






// // UserReportの状態を更新または挿入するメソッド
// protected function updateUserReportStatus($userId, $status)
// {
//     $userReport = UserReport::updateOrCreate(
//         ['user_id' => $userId], // user_idが存在すれば更新、なければ挿入
//         ['status' => $status]    // 更新するデータ
//     );
// }
    

 
    



// 検索機能
public function fill(Request $request)
{
    // $articles = Article::query();

    // クエリビルダーを初期化し、'停止' と '削除' を除外
    $articles = Article::query()->whereNotIn('status', ['停止', '削除']);
     


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

public function showDetail($id)
{
  
    $user = User::findOrFail($id);
    // 必要に応じて記事データを取得（例）
    $article = Article::first();
        // 現在ログインしているユーザーの名前を取得
        $userName = auth()->user()->name;
        $userImage = auth()->user()->image;

        return view('user_detail', compact('user','userName','userImage', 'article'));
   
}




public function useredit($id)
{
    
    $user = User::findOrFail($id);
    
    return view('user_edit',compact('user'));
}



// マイページ編集

public function update(Request $request){

    $user = Auth::user();
    // バリデーションルール
$request->validate([
            
'image' => 'nullable|image|max:2048', // 画像ファイルは最大2MB
'name' => 'required|string|max:255',
'email' => 'required|email|unique:users,email,' . $user->id, // 自分以外で重複していないか確認 
'profile' => 'nullable|string|max:1000', 
        ]);

 if ($request->hasFile('image')) {   
    if ($user->image) {

     // 既存の画像があれば削除
     Storage::disk('public')->delete(str_replace('/storage/', '', $user->iamge));
    }  
    // 新しいアイコンを保存
    $imagePath = $request->file('image')->store('images', 'public');
    $user->image = '/storage/' . $imagePath;
     }
        
    // フォーム入力内容を各カラムに反映
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->profile = $request->input('profile');

    // データベースに保存
    $user->save();

    return redirect()->route('user.detail',['id' => $user->id])->with('success', 'アカウント情報が更新されました。');

}


        




        
// // 依頼・受注状況確認


public function situationconfirm(Request $request)
{
    $user = Auth::user(); // 現在ログイン中のユーザーを取得

    // ユーザーが投稿した記事を取得
    $articles = Article::where('user_id', $user->id)->get();

    // ユーザーが投稿した記事のIDと一致するpost_idを持つ依頼を取得
    $requests = Requested::with('post') // 'post'リレーションを遅延読み込み
        ->whereIn('post_id', $articles->pluck('id')) // post_idが記事のIDと一致するものを取得
        ->get();

        // ユーザーが依頼した内容を取得
        // $userRequests = Requested::where('user_id', $user->id)->get();
        // ユーザーが依頼した内容を取得し、関連する記事も遅延読み込み
    $userRequests = Requested::with('post') // 'post' リレーションを遅延読み込み
    ->where('user_id', $user->id) // ユーザーのIDと一致する依頼を取得
    ->get();

    // return view('situation_conf', compact('articles', 'requests','userRequests')); // ビューにデータを渡す
    return view('situation_conf', compact('articles', 'requests','userRequests'));
}

// 依頼詳細ページを表示
public function requestshow($id)
{
    // 記事を取得
    $article = Article::findOrFail($id);

    // 記事に関連する依頼を取得
    $requests = Requested::with('post') // 'post'リレーションをロード
                        ->where('post_id', $id) // 指定した記事のpost_idに関連する依頼を取得
                        ->get();

    // ビューにデータを渡す
    return view('request_see', compact('article', 'requests'));
}




  

    
// いいね機能
    public function like($articleId)
    {
        $article = Article::findOrFail($articleId);
        $user = auth()->user();

         // roleカラムが2のユーザーのみ許可
    if ($user->role != 2) {
        return response()->json(['error' => 'この機能は利用できません。'], 403);
    }
    
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

         // roleカラムが2のユーザーのみ許可
    if ($user->role != 2) {
        return response()->json(['error' => 'この機能は利用できません。'], 403);
    }
    
        $existingLike = Like::where('article_id', $articleId)
                            ->where('user_id', $user->id)
                            ->first();
    
        if ($existingLike) {
            $existingLike->delete();
        }
    
        return response()->json(['success' => true]);
    }

    


// いいね一覧機能

// public function nice()
// { 
//     // likesテーブルからarticle_idを取得
//     $likes = Like::select('article_id') // article_idのみを選択
//                 ->paginate(8); // ページネーションを使用

//     // ビューにデータを渡す
//     return view('nice', compact('likes'));

// }

public function nice()
{ 
    // ログインユーザーのIDを取得
    $userId = Auth::id();

    // likesテーブルからログインユーザーのIDと一致するarticle_idを取得
    // $likes = Like::select('article_id') // article_idのみを選択
    //              ->where('user_id', $userId) // ログインユーザーのIDと一致
    //              ->paginate(8); // ページネーションを使用
    $likes = Like::with('article') // articleを一緒にロード
             ->where('user_id', $userId)
             ->paginate(8);

    // ビューにデータを渡す
    return view('nice', compact('likes'));
}



// 依頼関連
public function request($id)
{

    $article = Article::find($id);
    $user = Auth::user();


    // もし $article が見つからない場合、適切なエラーハンドリングを行う
    if (!$article) {
        abort(404); // 記事が見つからなければ404エラーを返す
    }

    // $article をビューに渡す
    return view('request', compact('article','user'));
    //  return view('request', compact('article'));
   
}


    public function confirm(Request $request)
    {
        // 入力データを一時的にセッションに保存する
        $article = Article::find($request->article_id); // 例として記事のIDを取得
        // $article = Article::find($article_id); // 修正：$article_idを使用
// 記事が存在しない場合のエラーハンドリング 12/23追加
    //  if (!$article) {
    //     return redirect()->back()->withErrors(['error' => '指定された記事が見つかりませんでした。']);
    // }

        $user = Auth::user();
  
    //  

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

    // 送信されたデータをデバッグ
    // dd($request->all()); // 送信されているすべてのデータを確認

    return view('request_conf', compact('user','article','title', 'price', 'deadline', 'phone', 'email', 'content'));
    // return view('request_conf', compact('article','title', 'price', 'deadline', 'phone', 'email', 'content'));
        
    }

    public function submit(Request $request)
{
    $user = Auth::user();

     
    
    // バリデーション
    // $validated = $request->validate([
    //     'post_id' => 'required|exists:articles,id',
    //     'user_id' => 'required|exists:users,id',
    //     'deadline' => 'required|date',
    //     'phone' => 'required|regex:/^[0-9]{10,11}$/',
    //     'email' => 'required|email',
    //     'content' => 'required|string|max:500',
    // ]);

     $validated = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'user_id' => 'required|exists:users,id',
            'deadline' => 'required|date',
            'phone' => 'required|regex:/^[0-9]{10,11}$/',
            'email' => 'required|email',
            'content' => 'required|string|max:500',
        ]);

    // if ($validated->fails()) {
    //     return redirect()->back()->withErrors($validated)->withInput();
    // }
    




   
    


    // // 保存処理
    // $requestContent = new RequestContent();
    // $requestContent->post_id = $request->article_id; // 記事のID
    // $requestContent->user_id = auth()->id(); 
    // $requestContent->content = $request->content;
    // $requestContent->phone_number = $request->phone;
    // $requestContent->email = $request->email;
    // $requestContent->date = $request->deadline;
    // $requestContent->save();

    // データ保存
    // Requested::create([
    //     'post_id' => $request->post_id, // 記事のID
    //     'user_id' => $request->user_id,       // 現在のユーザーID
    //     'content' => $request->content,    // 依頼内容
    //     'phone_number' => $request->phone, // 電話番号
    //     'email' => $request->email,        // メールアドレス
    //     'date' => $request->deadline,      // 希望納期
    // ]);

     Requested::create([
        'post_id' => $request->article_id, // 記事のID
        'user_id' => $request->user_id,       // 現在のユーザーID
        'content' => $request->content,    // 依頼内容
        'phone_number' => $request->phone, // 電話番号
        'email' => $request->email,        // メールアドレス
        'date' => $request->deadline,      // 希望納期
    ]);
    
        



    // 完了ページやリダイレクト先に進む
    return redirect()->route('situation.confirm')->with('success', '依頼が送信されました');
    // return redirect()->route('articles.index')->with('success', '依頼が送信されました');
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

//  $user = Auth::user();
    // 記事に関連するuser_idを取得
    $articleUserId = $article->user_id;

  

 // セッションにデータを保存
//  session(['article' => $article, 'user' => $user]);
session(['article' => $article, 'article_user_id' => $articleUserId]);

// リクエスト全体を確認する
// dd($request->all());



 // ビューに渡す
//  return view('report', ['article' => $article, 'user' => $user]);
return view('report', ['article' => $article, 'article_user_id' => $articleUserId]);

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

    // リクエスト全体を確認する
    // dd($request->all());

    //  return response()->json([
    //      'user_id' => $user->id, 
    //      'post_id' => $request->post_id, // ユーザー名を取得
    //      'reason' => $request->reason,
    //  ]);

    //     return redirect()->route('/')->with('success', '報告が送信されました。');
    // }

    return redirect()->route('articles.index')->with('success', '報告が送信されました。');
}

//   退会関連

public function withdraw()
{
    $user = Auth::user(); // 現在ログインしているユーザー

    if ($user) {
        // 対応する記事（articles/likeテーブル）を削除
        Article::where('user_id', $user->id)->delete();
        Like::where('user_id', $user->id)->delete();

        $user->delete(); // usersテーブルから削除
        

        // ログアウト
        Auth::logout();

        // セッションをクリア
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/')->with('success', '退会処理が完了しました。');
    }

    return redirect('/')->with('error', '退会処理に失敗しました。');
}
}
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