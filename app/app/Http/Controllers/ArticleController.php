<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;

class ArticleController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
         // すべての記事を取得
         $articles = Article::all(); // ここを追記


         $query = Article::query();

         // キーワード検索
         if ($request->filled('keyword')) {
             $keyword = $request->input('keyword');
             $query->where(function ($q) use ($keyword) {
                 $q->where('title', 'like', "%{$keyword}%")
                   ->orWhere('body', 'like', "%{$keyword}%");
             });
         }
 
         // 金額フィルター
         if ($request->filled('price')) {
             $price = $request->input('price');
             $query->where('price', '<=', $price);
         }
 
         // 結果を取得
         $articles = $query->get();


         // 記事一覧を表示
         return view('articles.index', compact('articles')); // ここを追記
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // // 投稿画面表示
        return view('articles.create'); // ここを追記
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    

    // user_idをリクエストに追加
    $request->merge(['user_id' => auth()->id()]);


           // リクエスト内容を確認するためにddを追加
        //    dd($request->all());
        
        
        // バリデーション
        $request->validate([
        'user_id' => 'required|integer',
        'name' => 'required|string|max:16',
        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        'title' => 'required|string|max:100',
        'price' => 'required|numeric',
        'status' => 'required|boolean',
        'body' => 'required|string',
    ]);


        //// 投稿内容保存処理
    // $article = Article::create([
    //     'title' => $request->title,
    //     'body' => $request->body,
    //     'status' => $request->status,
    // ]); // ここを追加




// ファイルアップロード処理
$imagePath = null;
if ($request->hasFile('image')) {
    $imagePath = $request->file('image')->store('images', 'public'); // publicディスクに保存
}

    $article = Article::create([
        'user_id' => $request->user_id,
        'name' => $request->name,
        'image' => $imagePath,
        'title' => $request->title,
        'price' => $request->price,
        'status' => $request->status,
        'body' => $request->body,
    ]); // ここを追加

    return redirect()->route('articles.index'); // ここを追加
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //// ビューから渡されたIDの記事を取得
    $article = Article::find($id);

    // 記事詳細画面を表示
    return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {// ビューから渡されたIDの記事を取得
      $article = Article::find((int) $id);  

   

     // 記事が見つからない場合に404エラーを返す
     if (!$article) {
         abort(404, 'Article not found');
     }

    // 記事編集画面を表示
    return view('articles.edit', compact('article')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 選択された記事データを取得
    $article = Article::find($id);

    // 編集処理実行
    $article->fill($request->all())->save();

    // 記事一覧画面へ
    return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //// 選択された記事データを取得
    $article = Article::find($id);

    // 削除処理実行
    $article->delete();

    // 記事一覧画面へ
    return redirect()->route('articles.index');
    }
}
