@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <style>
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

    <h1 class="text-center mb-4">この内容で依頼を完了しますか？</h1>

    <!-- 確認内容表示 -->
    <form action="{{ route('request.submit') }}" method="POST">
        @csrf

        <!-- 依頼内容のタイトル -->
        <div class="form-group">
            <label for="title">依頼内容のタイトル</label>
            <p>{{ $article->title }}</p>
        </div>

        <!-- 金額 -->
        <div class="form-group">
            <label for="price">金額</label>
            <p>¥{{ number_format($article->price) }}</p>
        </div>

        <!-- 希望納期 -->
        <div class="form-group">
            <label for="deadline">希望納期</label>
            <p>{{ $deadline }}</p>
        </div>

        <!-- 電話番号 -->
        <div class="form-group">
            <label for="phone">電話番号</label>
            <p>{{ $phone }}</p>
        </div>

        <!-- メールアドレス -->
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <p>{{ $email }}</p>
        </div>

        <!-- 依頼内容詳細 -->
        <div class="form-group">
            <label for="content">依頼内容詳細</label>
            <p>{{ $content }}</p>
        </div>

        <!-- 戻る & 最終確認へ -->
        <div class="form-actions">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-primary">送信</button>
        </div>
    </form>
</div>
@endsection
