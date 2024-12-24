@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="header p-3 ">

        <!-- ユーザー情報 -->
        <div class="user-info d-flex align-items-center mb-3 pb-3 border-bottom">
    <a href="{{ route('user.detail', ['id' => $user->id]) }}">
        <img src="{{ asset($user->image ?? 'default_icon.png') }}" alt="ユーザーアイコン" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;">
    </a>
    <span class="h5">{{ $user->name ?? 'ゲスト' }}</span>
</div>


        <!-- ナビゲーションリンク -->
        <div class="navigation mb-3">
        <div class="nav-link mb-2 border-bottom p-2" style="font-size: 1.1rem; cursor: pointer;" onclick="location.href='{{ route('articles.create', $user ->id) }}'">

                <i class="bi bi-file-earmark-plus me-2"></i>案件を作成する
            </div>
            <div class="nav-link mb-2 border-bottom p-2" style="font-size: 1.1rem; cursor: pointer;" onclick="location.href='{{ url('situation_conf') }}'">
                <i class="bi bi-clock-history me-2"></i>依頼・案件登録履歴
            </div>
            <div class="nav-link mb-2 border-bottom p-2" style="font-size: 1.1rem; cursor: pointer;" onclick="location.href='{{ url('nice') }}'">
                <i class="bi bi-heart me-2"></i>いいね一覧
            </div>
        </div>

        <!-- ユーザーアクション -->
        <div class="user-actions d-flex flex-column align-items-start ">
            <!-- <span class="mb-2 border-bottom p-2" style="font-size: 1rem; display: block; width: 100%;">{{ $user->email ?? 'メール未登録' }}</span>
            <div class="nav-link mb-2 border-bottom p-2" style="font-size: 1.1rem; cursor: pointer; display: block; width: 100%;" onclick="location.href='{{ url('logout') }}'">
                <i class="bi bi-box-arrow-right me-2"></i>ログアウト
            </div> -->
           

            <div class="nav-link border-bottom p-2" style="font-size: 1.1rem; cursor: pointer; display: block; width: 100%;"
             onclick="if(confirm('本当に退会しますか？')) document.getElementById('withdraw-form').submit();">
            <i class="bi bi-x-circle me-2"></i>退会する
            </div>

           <form id="withdraw-form" action="{{ route('withdraw') }}" method="POST" style="display: none;">
           @csrf
          </form>
        </div>

    </div>
</div>
@endsection
