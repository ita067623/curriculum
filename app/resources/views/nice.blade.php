@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>いいね一覧</h1>
    <div class="like-list row">
        @if(isset($likes) && $likes->count())
            @foreach($likes as $like)
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
    <div class="card position-relative">
        <!-- 記事に対応する画像を表示 -->
        <img src="{{ $like->image_url }}" alt="いいね画像" class="card-img-top" style="width: 100%; height: auto;">
        <!-- ♡アイコンを右上に配置 -->
        <span class="like-icon position-absolute top-0 end-0 p-3" style="font-size: 40px; color: #ff4081; z-index: 1;">
            ♥
        </span>

        <div class="card-body">
            <h5 class="card-title">{{ $like->title }}</h5>
        </div>
    </div>
</div>

            @endforeach
        @else
            <p>まだいいねされた記事はありません。</p>
        @endif
    </div>

    <div class="pagination">
        {{ $likes->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
