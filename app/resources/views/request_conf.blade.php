@extends('layout')

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
        .info-group {
            margin-bottom: 15px;
        }
        .info-group label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        .info-group .info-value {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn {
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            border-radius: 5px;
            display: inline-block;
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

    <h1 class="text-center mb-4">依頼内容確認</h1>
    <form action="{{ route('request.complete') }}" method="POST">
        @csrf

        <!-- ①依頼内容のタイトル -->
        <div class="info-group">
            <label for="title">依頼内容のタイトル</label>
            <div class="info-value">{{ $data['title'] }}</div>
        </div>

        <!-- ②希望納期 -->
        <div class="info-group">
            <label for="deadline">希望納期</label>
            <div class="info-value">{{ $data['deadline'] }}</div>
        </div>

        <!-- ③依頼内容詳細 -->
        <div class="info-group">
            <label for="details">依頼内容詳細</label>
            <div class="info-value">{{ $data['details'] }}</div>
        </div>

        <!-- ④メールアドレス -->
        <div class="info-group">
            <label for="email">メールアドレス</label>
            <div class="info-value">{{ $data['email'] }}</div>
        </div>

        <!-- ⑤電話番号 -->
        <div class="info-group">
            <label for="phone">電話番号</label>
            <div class="info-value">{{ $data['phone'] }}</div>
        </div>

        <!-- ⑥戻る & ⑦依頼を確定する -->
        <div class="form-actions">
            <a href="{{ route('request.input') }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-primary">依頼を確定する</button>
        </div>
    </form>
</div>
@endsection
