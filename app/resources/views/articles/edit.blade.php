@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">記事詳細</div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                <th>投稿者名</th>
                  <th>タイトル</th>
                  <th>イメージ画像</th>
                  <th>本文</th>
                  <th>料金</th>
                  <th>状態</th>
                </tr>
              </thead>
              <tbody>
                @if(isset($article))
                <tr>
                <td>{{ $article->name }}</td>
                  <td>{{ $article->title }}</td>
                  <td>{{ $article->image }}</td>
                  <td>{{ $article->body }}</td>
                  <td>{{ $article->price }}</td>
                  <td>{{ $article->situation }}</td>
                </tr>
                @endif
              </tbody>
            </table>
            @if(isset($article))
            <div class="text-center">
                <button type="button" class="btn btn-secondary" style="width: 200px;"  onClick="history.back()">戻る</button>
                
          
                <form style="display:inline" action="{{ route('articles.destroy', $article->id) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-3"style="width: 200px;" >
                        {{ __('削除') }}
                    </button>
                </form>
             
                <button type="button" class="btn btn-primary ml-3" style="width: 200px;" onClick="location.href='{{ route('articles.edit', $article->id) }}'">
                    編集
                </button>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
