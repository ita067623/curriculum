@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 700px; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
        <div class="card-body">
            <h1 class="text-center mb-4">依頼内容入力</h1>
            <form action="{{ route('request.confirm') }}" method="POST">
                @csrf


                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="title" value="{{ $article->title }}">
                <input type="hidden" name="price" value="{{ $article->price }}">
                <input type="hidden" name="article_id" value="{{ $article->id }}">

                <!-- 依頼内容のタイトル -->
                <div class="mb-3">
                    <label for="title" class="form-label">依頼内容のタイトル</label>
                    <h2 class="h5 mb-1">{{ $article->title }}</h2>
                </div>

                <!-- 金額 -->
                <div class="mb-3">
                    <p class="mb-0">金額: ¥{{ number_format($article->price) }}</p>
                </div>

                <!-- 希望納期 -->
                <div class="mb-3">
                    <label for="deadline" class="form-label">希望納期</label>
                    <input type="date" id="deadline" name="deadline" class="form-control" required>
                </div>

                <!-- 電話番号 -->
                <div class="mb-3">
                    <label for="phone" class="form-label">電話番号</label>
                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="電話番号を入力" required>
                </div>

                <!-- メールアドレス -->
                <div class="mb-3">
                    <label for="email" class="form-label">メールアドレス</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="メールアドレスを入力" required>
                </div>

                <!-- 依頼内容詳細 -->
                <div class="mb-3">
                    <label for="content" class="form-label">依頼内容詳細</label>
                    <textarea id="content" name="content" class="form-control" rows="5" placeholder="依頼内容の詳細を入力" required></textarea>
                </div>

                <!-- 戻る & 確認へ -->
                <div class="d-flex justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
                    <button type="submit" class="btn btn-primary">確認へ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
