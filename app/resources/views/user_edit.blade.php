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

    <h1 class="text-center mb-4">アカウント情報編集</h1>
    <form action="{{ route('user.edit.confirm') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- ①アイコン画像 -->
        <div class="form-group text-center">
            <label for="icon">アイコン画像</label>
            <br>
            <img src="{{ $user->icon }}" alt="現在のアイコン画像" class="rounded-circle mb-2" style="width: 100px; height: 100px;">
            <input type="file" class="form-control-file mt-2" id="icon" name="icon">
        </div>

        <!-- ②氏名 -->
        <div class="form-group">
            <label for="name">氏名</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
        </div>

        <!-- ③メールアドレス -->
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
        </div>

        <!-- ④自己紹介・詳細 -->
        <div class="form-group">
            <label for="details">自己紹介・詳細</label>
            <textarea class="form-control" id="details" name="details" rows="5">{{ old('details', $user->details) }}</textarea>
        </div>

        <!-- ⑤戻る & ⑥確認へ -->
        <div class="form-actions">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-primary">確認へ</button>
        </div>
    </form>
</div>
@endsection
