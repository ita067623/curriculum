@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">記事: {{ $article->title }} の依頼状況</h1>
    
    <!-- 依頼のリスト表示 -->
    @if(isset($requests) && $requests->count())
        @foreach($requests as $request)
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $request->post->title }}</h5>
                    <p><strong>依頼内容:</strong> {{ $request->content }}</p>
                    <p><strong>電話番号:</strong> {{ $request->phone_number }}</p>
                    <p><strong>メールアドレス:</strong> {{ $request->email }}</p>
                    <p><strong>納期:</strong> {{ $request->date }}</p>
                    <p><strong>依頼者ID:</strong> {{ $request->user_id }}</p>
                    <p><strong>依頼ID:</strong> {{ $request->id }}</p>
                    <p><strong>依頼日時:</strong> {{ $request->created_at }}</p>
                    
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center">該当する依頼が見つかりませんでした。</p>
    @endif
</div>
@endsection
