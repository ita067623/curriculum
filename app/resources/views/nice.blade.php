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
        @if(!empty($like->article->image))
        <img src="{{ asset('storage/' . $like->article->image) }}" alt="画像は登録されていません" class="card-img-top" style="max-height: 130px; object-fit: cover;"">

        @else
        <div class="card-img-top bg-white d-flex align-items-center justify-content-center" 
         style="height: 130px; color: #ccc; font-size: 14px;">
        No Image
    </div>
    @endif
       
        <div class="card-body d-flex align-items-center justify-content-between">
    <!-- タイトル -->
    <h5 class="card-title mb-0">{{ $like->article->title ?? 'タイトルなし' }}</h5>

    <!-- ♡アイコン -->
    <span class="like-icon" style="font-size: 40px; color: #ff4081;">
        ♥
    </span>
</div>


       
                    </div>
                </div>

             @endforeach 

            <div class="pagination">
                {{ $likes->links('pagination::bootstrap-4') }}
            </div>
        @else
            <p>まだいいねされた記事はありません。</p>
        @endif
    </div>
</div>
@endsection

     