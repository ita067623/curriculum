@extends('layouts.app')

@section('content')
<div class="container">
  <!-- ヘッダー -->

  <form method="GET" action="{{ url('fill') }}" class="d-flex flex-wrap align-items-center justify-content-between mb-4">
    <div class="col-md-4 mb-3">
      <input type="text" class="form-control" placeholder="内容ORタイトルキーワード入力" name="keyword"  value="{{ request('keyword') }}" />
    </div>

    <div class="col-md-3 mb-3">
      <select class="form-control" name="min_price">
        <option value="">最低金額を選択</option>
        <option value="1000" {{ request('min_price') == 1000 ? 'selected' : '' }}>1,000円</option>
        <option value="2000" {{ request('min_price') == 2000 ? 'selected' : '' }}>2,000円</option>
        <option value="3000" {{ request('min_price') == 3000 ? 'selected' : '' }}>3,000円</option>
        <option value="4000" {{ request('min_price') == 4000 ? 'selected' : '' }}>4,000円</option>
        <option value="5000" {{ request('min_price') == 5000 ? 'selected' : '' }}>5,000円</option>
        <option value="6000" {{ request('max_price') == 6000 ? 'selected' : '' }}>6,000円</option>
        <option value="7000" {{ request('max_price') == 7000 ? 'selected' : '' }}>7,000円</option>
        <option value="8000" {{ request('max_price') == 8000 ? 'selected' : '' }}>8,000円</option>
        <option value="9000" {{ request('max_price') == 9000 ? 'selected' : '' }}>9,000円</option>
        <option value="10000" {{ request('max_price') == 10000 ? 'selected' : '' }}>10,000円</option>
      </select>
    </div>

    <div class="col-md-1 mb-3">
      <span class="d-flex align-items-center justify-content-center">～</span>
    </div>

    <div class="col-md-3 mb-3">
      <select class="form-control" name="max_price">
        <option value="">最高金額を選択</option>
        <option value="1000" {{ request('min_price') == 1000 ? 'selected' : '' }}>1,000円</option>
        <option value="2000" {{ request('min_price') == 2000 ? 'selected' : '' }}>2,000円</option>
        <option value="3000" {{ request('min_price') == 3000 ? 'selected' : '' }}>3,000円</option>
        <option value="4000" {{ request('min_price') == 4000 ? 'selected' : '' }}>4,000円</option>
        <option value="5000" {{ request('min_price') == 5000 ? 'selected' : '' }}>5,000円</option>
        <option value="6000" {{ request('max_price') == 6000 ? 'selected' : '' }}>6,000円</option>
        <option value="7000" {{ request('max_price') == 7000 ? 'selected' : '' }}>7,000円</option>
        <option value="8000" {{ request('max_price') == 8000 ? 'selected' : '' }}>8,000円</option>
        <option value="9000" {{ request('max_price') == 9000 ? 'selected' : '' }}>9,000円</option>
        <option value="10000" {{ request('max_price') == 10000 ? 'selected' : '' }}>10,000円</option>
      </select>
    </div>

    <div class="col-md-1 mb-3">
      <button type="submit" class="btn btn-primary w-100">検索</button>
    </div>
  </form>

  <!-- 案件表示 -->
  <div class="row">
    @if(isset($articles) && $articles->count())
      @foreach($articles as $article)
        <div class="col-md-4 mb-4">
          <div class="card h-100 position-relative">
            <label>
              <a href="javascript:void(0);" class="like-button position-absolute" style="top: 10px; right: 10px;" 
                 data-article-id="{{ $article->id }}" data-liked="{{ $article->isLikedBy(auth()->user()) }}">
                {{ $article->isLikedBy(auth()->user()) ? '♥' : '♡' }}
              </a>
            </label>
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

@extends('like_js')
