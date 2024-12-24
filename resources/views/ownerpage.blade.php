@extends('layouts.app')

@section('content') 
<div class="d-flex flex-column min-vh-100">
    <div class="container my-4">
        <h1 class="text-center mb-4">管理者ページ</h1>

        <!-- ボタン -->
        <div class="row justify-content-center">
            <!-- ユーザー案件検索 -->
            <div class="col-md-4 mb-3">
                <a href="{{ route('owner_users.index') }}" class="btn btn-primary btn-block">違反案件操作</a>
            </div>

            
            <!-- 停止・削除案件一覧-->
            <div class="col-md-4 mb-3">
                <a href="{{ route('ownerpage.suspended_deleted_users') }}" class="btn btn-warning btn-block">停止・削除案件一覧</a>
            </div>

            <!-- 違反者報告一覧 -->
            <div class="col-md-4 mb-3">
                <a href="{{ route('ownerpage.detail') }}" class="btn btn-success btn-block">停止違反者一覧</a>
            </div>


            <!-- アカウント停止操作 -->
            <div class="col-md-4 mb-3">
                <a href="{{ route('ownerpage.suspend') }}" class="btn btn-danger btn-block">アカウント停止操作</a>
            </div>

        </div>
    </div>

    <!-- フッター -->
    <footer class="mt-auto bg-dark text-white text-center py-3">
        <p class="mb-0">© 2024 管理者ページ</p>
    </footer>
</div>
@endsection
