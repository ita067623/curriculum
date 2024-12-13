@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <style>
        /* 必要なカスタムCSS */
        .container {
            max-width: 700px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-control {
            margin-bottom: 20px;
            border-radius: 5px;
            padding: 10px;
        }
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-secondary {
            background-color: gray;
        }
        .btn-primary {
            background-color: orange;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>

    <h1 class="text-center mb-4">依頼内容入力</h1>
    <form action="{{ route('request.confirm') }}" method="POST">
    @csrf

    <!-- 依頼内容のタイトル（隠しフィールド） -->
    <input type="hidden" name="title" value="{{ $article->title }}">

    <!-- 金額（隠しフィールド） -->
    <input type="hidden" name="price" value="{{ $article->price }}">

    <!-- article_id（隠しフィールド） -->
    <input type="hidden" name="article_id" value="{{ $article->id }}">

    <!-- その他のフォームフィールド -->
    <div class="form-group">
        <label for="title">依頼内容のタイトル</label>
        <h2 class="h5 mb-1">{{ $article->title }}</h2>
    </div>

    <div class="form-group">
        <p class="mb-0">金額: ¥{{ number_format($article->price) }}</p>
    </div>

    <!-- 希望納期 -->
    <div class="form-group">
        <label for="deadline">希望納期</label>
        <input type="date" id="deadline" name="deadline" class="form-control" required>
    </div>

    <!-- 電話番号 -->
    <div class="form-group">
        <label for="phone">電話番号</label>
        <input type="tel" id="phone" name="phone" class="form-control" placeholder="電話番号を入力" required>
    </div>

    <!-- メールアドレス -->
    <div class="form-group">
        <label for="email">メールアドレス</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="メールアドレスを入力" required>
    </div>

    <!-- 依頼内容詳細 -->
    <div class="form-group">
        <label for="content">依頼内容詳細</label>
        <textarea id="content" name="content" class="form-control" rows="5" placeholder="依頼内容の詳細を入力" required></textarea>
    </div>

    <!-- 戻る & ⑧確認へ -->
    <div class="form-actions">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
        <button type="submit" class="btn btn-primary">確認へ</button>
    </div>
</form>
</div>
@endsection
