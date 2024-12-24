@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Bootstrapのカードを使用してフォームを囲みます -->
    <div class="card mx-auto" style="max-width: 700px; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
        <div class="card-body">
            <h1 class="text-center mb-4">この内容で依頼を完了しますか？</h1>

            <form action="{{ route('request.submit') }}" method="POST">
             
                @csrf

                <!-- <input type="hidden" name="post_id" value="{{ $article->id }}"> -->
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="deadline" value="{{ $deadline }}">
                <input type="hidden" name="phone" value="{{ $phone }}">
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="content" value="{{ $content }}">

                <!-- 依頼内容のタイトル -->
                <div class="mb-3">
                <strong> <label for="title" class="form-label">依頼内容のタイトル</label></strong>
                <p style="margin-bottom: 0;">{{ $article->title }}</p>
                <hr style="border: 0.5px solid #000; margin-top: 1px;">
                </div>

                <!-- 金額 -->
                <div class="mb-3">
                <strong><label for="price" class="form-label">金額</label></strong>
                <p style="margin-bottom: 0;">¥{{ number_format($article->price) }}</p>
                <hr style="border: 0.5px solid #000; margin-top: 1px;">
                </div>

                <!-- 希望納期 -->
                <div class="mb-3">
                <strong><label for="deadline" class="form-label">希望納期</label></strong>
                <p style="margin-bottom: 0;">{{ $deadline }}</p>
                <hr style="border: 0.5px solid #000; margin-top: 1px;">
                </div>

                <!-- 電話番号 -->
                <div class="mb-3">
                <strong><label for="phone" class="form-label">電話番号</label></strong>
                <p style="margin-bottom: 0;">{{ $phone }}</p>
                <hr style="border: 0.5px solid #000; margin-top: 1px;">
                </div>

                <!-- メールアドレス -->
                <div class="mb-3">
                <strong><label for="email" class="form-label">メールアドレス</label></strong>
                <p style="margin-bottom: 0;">{{ $email }}</p>
                <hr style="border: 0.5px solid #000; margin-top: 1px;">
                </div>

                <!-- 依頼内容詳細 -->
                <div class="mb-3">
                <strong><label for="content" class="form-label">依頼内容詳細</label></strong>
                <p style="margin-bottom: 0;">{{ $content }}</p>
                    <hr style="border: 0.5px solid #000; margin-top: 1px;">
                </div>

                <!-- 戻る & 送信ボタン -->
                <div class="d-flex justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
                    <button type="submit" class="btn btn-primary">送信</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
