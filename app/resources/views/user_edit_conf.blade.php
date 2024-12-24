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
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-control {
            border: none;
            background: #f9f9f9;
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

    <h1 class="text-center mb-4">アカウント情報確認</h1>

    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- ①アイコン画像 -->
        <div class="form-group text-center">
            <label>アイコン画像</label>
            <br>
            @if ($data['icon'])
                <img src="{{ $data['icon'] }}" alt="新しいアイコン画像" class="rounded-circle mb-2" style="width: 100px; height: 100px;">
            @else
                <img src="{{ auth()->user()->icon }}" alt="現在のアイコン画像" class="rounded-circle mb-2" style="width: 100px; height: 100px;">
            @endif
        </div>

        <!-- ②氏名 -->
        <div class="form-group">
            <label>氏名</label>
            <div class="form-control">{{ $data['name'] }}</div>
        </div>

        <!-- ③メールアドレス -->
        <div class="form-group">
            <label>メールアドレス</label>
            <div class="form-control">{{ $data['email'] }}</div>
        </div>

        <!-- ④自己紹介・詳細 -->
        <div class="form-group">
            <label>自己紹介・詳細</label>
            <div class="form-control">{{ $data['details'] }}</div>
        </div>

        <!-- ⑤戻る & ⑥確定 -->
        <div class="form-actions">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-primary">確定</button>
        </div>
    </form>
</div>
@endsection
