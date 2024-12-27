@extends('layouts.app')

@section('content') 
<body class="bg-light">

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h1 class="card-title">未登録ユーザー専用ページ</h1>
            </div>
            <div class="card-body">
                <p class="card-text">ゲストとしてログインしました。</p>
                
                <!-- 会員登録してログインするボタン -->
                <!-- <form action="{{ route('register') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">会員登録してログインする</button>
                </form> -->

                <!-- ゲストのまま利用するボタン -->
                <a href="{{ route('articles.index') }}" class="btn btn-secondary d-inline">
                    ゲストのまま利用する
                </a>
            </div>
        </div>
    </div>

@endsection
