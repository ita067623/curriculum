@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="text-center mb-4">投稿が停止・削除されたユーザーリスト</h1>

    <!-- ユーザーリスト -->
    <table class="table table-bordered text-center">
        <thead class="thead-dark">
            <tr>
                <th>ユーザーID</th>
                <th>ユーザー名</th>
                <th>停止・削除回数</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->user_id }}</td>
                    <td>{{ $article->user->name ?? '未登録' }}</td>
                    <td>{{ $article->count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ページネーション -->
    <div class="d-flex justify-content-center">
        {{ $articles->links() }}
    </div>
</div>
@endsection
