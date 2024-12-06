@extends('layouts.app')

@section('content')
<div class="container">
  <!-- ヘッダー -->
  <div class="row mb-4">
    <div class="col-md-6">
      <input type="text" class="form-control" placeholder="内容ORタイトルキーワード入力" name="keyword" />
    </div>
    <div class="col-md-3">
      <select class="form-control" name="price">
        <option value="">金額を選択</option>
        <option value="1000" {{ request('amount') == 1000 ? 'selected' : '' }}>1,000円以下</option>
        <option value="5000" {{ request('amount') == 5000 ? 'selected' : '' }}>5,000円以下</option>
        <option value="10000" {{ request('amount') == 10000 ? 'selected' : '' }}>10,000円以下</option>
      </select>
    </div>
    <div class="col-md-3">
      <button class="btn btn-primary w-100">検索</button>
    </div>
  </div>

  <!-- 案件表示 -->
  <div class="row text-center">
    @if(isset($articles) && $articles->count())
      @foreach($articles as $article)
        <div class="col-md-4 mb-4">
          <div class="card h-100  position-relative">
          <label> <a href="javascript:void(0);" 
   class="like-button position-absolute" 
   style="top: 10px; right: 10px;" 
   data-article-id="{{ $article->id }}" 
   data-liked="{{ $article->isLikedBy(auth()->user()) }}">
   {{ $article->isLikedBy(auth()->user()) ? '♥' : '♡' }}
</a></label>
            <div class="card-body">
              <h5 class="card-title">
                <a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a>
              </h5>
              <p class="card-text">{{ $article->body }}</p>
              <p class="text-muted">料金: {{ $article->price }}</p>
            </div>
          </div>
        </div>
      @endforeach
    @else
      <p class="text-center w-100">該当する案件が見つかりませんでした。</p>
    @endif
  </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // CSRFトークンを取得
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Ajaxのデフォルト設定にCSRFトークンを追加
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $('.like-button').on('click', function() {
            console.log('Button clicked');  // クリック時にこのメッセージが表示されるか確認

            var $this = $(this);
            var article_id = $this.data('article-id');  // 修正: data-article-idを取得
            var isLiked = $this.data('liked');  // 修正: いいねの状態を取得

            console.log('Article ID:', article_id);  // コンソールにIDを表示

            // POSTリクエストのURLを名前付きルートで生成
            var url = isLiked 
                ? "{{ route('unlike', ['article' => '__article_id__']) }}" 
                : "{{ route('like', ['article' => '__article_id__']) }}";
            
            // article_idをURLに埋め込む
            url = url.replace('__article_id__', article_id);

            // Ajaxリクエスト
            $.ajax({
                url: url, // 生成したURLを使用
                type: isLiked ? 'DELETE' : 'POST', // isLikedに応じてPOSTまたはDELETE
                dataType: 'json',
                data: { article_id: article_id },
                success: function(response) {
                    console.log('Ajax Success');  // 成功した場合のログ

                    // UIの更新（いいねの状態を反転）
                    if (isLiked) {
                        $this.text('♡');  // いいねを外す
                    } else {
                        $this.text('♥');  // いいねをつける
                    }

                    // likedの状態を切り替え
                    $this.data('liked', !isLiked);
                },
                error: function(xhr, status, error) {
                    console.error('Ajax Error:', error);  // エラー時のログ
                    console.log('Request URL:', url);  // URLの確認
                    console.log('Request Data:', { article_id: article_id });  // 送信データの確認
                }
            });
        });
    });
</script>

