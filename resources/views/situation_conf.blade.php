@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">依頼・案件状況</h1>
    
    <!-- 依頼確認セクション -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <h2 class="text-center mb-4">依頼確認</h2>
            @if(isset($requests) && $requests->count())
                @foreach($requests as $request)
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold">
                                <!-- requestのpostにアクセス -->
                                <a href="{{ route('requests.show', $request->post->id) }}" class="text-decoration-none">
                                    {{ $request->post->title }} <!-- ここで関連する記事のタイトルを表示 -->
                                </a>
                            </h5>
                            <p class="card-text mb-2">{{ Str::limit($request->content, 100) }}</p>
                            <p class="text-muted mb-0">納期: {{ $request->date }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center text-muted">該当する依頼が見つかりませんでした。</p>
            @endif
        </div>
    </div>

    <!-- 案件編集セクション -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <h2 class="text-center mb-4">案件編集</h2>
            @if(isset($articles) && $articles->count())
                @foreach($articles as $article)
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold">
                                <a href="{{ route('articles.edit', $article->id) }}" class="text-decoration-none">
                                    {{ $article->title }}
                                </a>
                            </h5>
                            <p class="card-text mb-2">{{ Str::limit($article->content, 100) }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center text-muted">編集可能な案件が見つかりませんでした。</p>
            @endif
        </div>
    </div>

    <!-- ログイン者が依頼した内容 -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <h2 class="text-center mb-4">あなたがした依頼</h2>
            @if(isset($userRequests) && $userRequests->count())
                @foreach($userRequests as $userRequest)
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                        
<a href="{{ route('articles.show', $userRequest->post->id) }}" class="text-decoration-none">
                            <h5 class="card-title">依頼ID: {{ $userRequest->id }}</h5>
                        </a>
                            <!-- <h5 class="card-title">依頼ID: {{ $userRequest->id }}</h5>
                            </a> -->
                            <p class="card-text">納期: {{ $userRequest->date }}</p>
                            <p class="text-muted">依頼日: {{ $userRequest->created_at }}</p>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center text-muted">まだ依頼した内容がありません。</p>
            @endif
        </div>
    </div>
</div>
@endsection


