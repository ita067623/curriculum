@extends('layouts.app')

@section('content')
    <!-- 上のセクション -->
    <div class="container my-4 p-4 bg-light rounded shadow-sm">
    <div class="row pb-3 mb-3 align-items-center">
        <!-- タイトル -->
        <div class="col-6">
            <h2 class="h5 mb-1">{{ $article->title }}</h2>
        </div>
        <!-- 画像 -->
        <div class="col-6" style="height: 100px;">
            <img src="{{ asset('storage/'. $article->image) }}" 
                 alt="イメージ画像" 
                 class="img-fluid w-100 rounded" 
                 style="height: 200px; object-fit: cover;  margin-top: -43px; transform: translateX(25px);">
        </div>
    </div>
</div>


    <!-- 下のセクション -->
    <div class="container my-4 p-4 bg-white rounded shadow-sm">
        <!-- 情報部分 -->
        <div class="row pb-3 mb-3 align-items-center">
            <!-- ユーザーアイコン -->
            <div class="col-auto">
                <img src="{{ asset($user->image ?? 'default_icon.png') }}"alt="ユーザーアイコン" class="rounded-circle" 
                style="width: 50px; height: 50px; object-fit: cover;">

                     <!-- <img src="{{ asset($user->image ?? 'default_icon.png') }}" alt="ユーザーアイコン" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;"> -->
            </div>
            <!-- 名前と金額 -->
            <div class="col">
                <p class="mb-1">名前: {{ $article->name }}</p>
                <p class="mb-0">金額: ¥{{ number_format($article->price) }}</p>
                <p class="mb-1">請負状況{{ $article->situation?? 'データなし' }}</p>
                
               
               
            </div>
            <!-- 違反報告 -->
            <div class="col-auto">
                <a href="{{ route('report', ['id' => $article->id]) }}" class="text-danger">違反報告</a>
            </div>
        </div>

        <!-- 案件詳細部分 -->
        <div class="mb-4">
            <h3 class="h6">案件詳細</h3>
            <p>{{ $article->body }}</p>
            
        </div>

        <!-- ボタン部分 -->
        <div class="d-flex justify-content-between">
            <a href="javascript:history.back();" class="btn btn-success">戻る</a>
            <div class="d-flex align-items-center">
                <a href="{{ route('request', ['id' => $article->id]) }}" class="btn btn-primary me-2">依頼する</a>
                <form action="{{ route('nice', ['id' => $article->id]) }}" method="POST">
                    @csrf
                
                </form>
            </div>
        </div>
    </div>
@endsection
