@extends('layouts.app')

@section('content')
  <div class="container mt-5">
    <h1 class="text-center mb-4">依頼・案件状況</h1>
    
    <div class="row text-center">
      @if(isset($articles) && $articles->count())
        @foreach($articles as $article)
          <div class="col-md-4 mb-4">
            <div class="card h-100 position-relative">
              <!-- いいねボタン -->
              <label> <a href="javascript:void(0);" 
                 class="like-button position-absolute" 
                 style="top: 10px; right: 10px;" 
                 data-article-id="{{ $article->id }}" 
                 data-liked="{{ $article->isLikedBy(auth()->user()) }}">
                {{ $article->isLikedBy(auth()->user()) ? '♥' : '♡' }}
              </a></label> 

              <!-- カード本文 -->
              <div class="card-body">
                <h5 class="card-title">
                  <a href="{{ route('articles.show', $article->id) }}" class="text-decoration-none">
                    {{ $article->title }}
                  </a>
                </h5>
                <p class="card-text">{{ Str::limit($article->body, 100) }}</p> <!-- 内容が長い場合、100文字に制限 -->
                <p class="text-muted">料金: ¥{{ number_format($article->price) }}</p> <!-- 価格をフォーマット -->
              </div>
            </div>
          </div>
        @endforeach
      @else
        <p class="text-center w-100">該当する案件が見つかりませんでした。</p>
      @endif
    </div>

    <!-- ページネーションを使用しない場合は削除 -->
  </div>
@endsection
