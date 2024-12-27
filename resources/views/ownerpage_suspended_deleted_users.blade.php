@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h1 class="text-center mb-4">投稿リスト</h1>

    
    <table class="table table-bordered text-center">
        <thead class="thead-dark">
            <tr>
            <th>投稿ID</th>
                <th>投稿タイトル</th>
                <th>報告回数</th>
                <th>状態変更</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                <td>{{ $article->id ?? '未登録' }}</td>   
                    <td>{{ $article-> title ?? '未登録'}}</td>
                    <td>{{ $article->report_count }}</td>
                    <td>
                        @if($article->status != '停止') 
                            <form action="{{ route('articles.updateStatus', ['id' => $article->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-warning">停止に変更</button>
                            </form>
                        @else
                            停止中
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div class="d-flex justify-content-center">
        {{ $articles->links() }}
    </div>
</div>
@endsection

