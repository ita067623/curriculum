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
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">ログアウト</button>
                </form>
            </div>
        </div>
    </div>
    
    @endsection