@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <style>
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .image img, .user-info img {
            border-radius: 5px;
            max-width: 100%;
            height: auto;
        }
        .user-info img {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }
        .user-name h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .user-detail p {
            font-size: 1rem;
            line-height: 1.5;
        }
        .btn {
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            border-radius: 5px;
            background-color: gray;
            display: inline-block;
            margin-top: 20px;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>

    <div class="header">
        <h1>ユーザー詳細</h1>
    </div>

    <!-- ①イメージ画像 -->
    <div class="image text-center mb-4">
        <img src="{{ asset($user->image_path ?? 'default_image.png') }}" alt="ユーザーイメージ" class="img-fluid rounded">
    </div>

    <!-- ②ユーザーアイコン -->
    <div class="user-info text-center mb-3">
        <img src="{{ asset($user->icon_path ?? 'default_icon.png') }}" alt="ユーザーアイコン" class="rounded-circle">
    </div>

    <!-- ③名前 -->
    <div class="user-name text-center mb-3">
        <h2>{{ $user->name }}</h2>
    </div>

    <!-- ④ユーザー詳細 -->
    <div class="user-detail mb-4">
        <p>{{ nl2br(e($user->detail)) }}</p>
    </div>

    <!-- ⑤戻る -->
    <div class="text-center">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
    </div>
</div>
@endsection
