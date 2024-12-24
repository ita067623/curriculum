@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">記事編集</div>

        <div class="card-body">

      
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <form action="{{ route('articles.update', $article->id) }}" method="POST">
            @csrf
            @method('PUT')

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
                  <tr>
                    <td>{{ $article->name }}</td>
                    <td>
                      <input type="text" class="form-control" name="title" value="{{ old('title', $article->title) }}" required>
                    </td>
                    <td>
  <input type="file" class="form-control" name="image" accept="image/*">
  @if ($article->image)
    <div class="mt-2">
      <p>現在の画像: <a href="{{ asset('storage/' . $article->image) }}" target="_blank">表示</a></p>
    </div>
  @endif
</td>
                    <td>
                      <textarea name="body" class="form-control" rows="3" required>{{ old('body', $article->body) }}</textarea>
                    </td>
                    <!-- <td>
                      <input type="number" class="form-control" name="price" value="{{ old('price', $article->price) }}" required>
                    </td> -->
                    <td>
  <select class="form-control" name="price" required>
    <option value="1000" {{ old('price', $article->price) == 1000 ? 'selected' : '' }}>1000</option>
    <option value="2000" {{ old('price', $article->price) == 2000 ? 'selected' : '' }}>2000</option>
    <option value="3000" {{ old('price', $article->price) == 3000 ? 'selected' : '' }}>3000</option>
    <option value="4000" {{ old('price', $article->price) == 4000 ? 'selected' : '' }}>4000</option>
    <option value="5000" {{ old('price', $article->price) == 5000 ? 'selected' : '' }}>5000</option>
    <option value="6000" {{ old('price', $article->price) == 6000 ? 'selected' : '' }}>6000</option>
    <option value="7000" {{ old('price', $article->price) == 7000 ? 'selected' : '' }}>7000</option>
    <option value="8000" {{ old('price', $article->price) == 8000 ? 'selected' : '' }}>8000</option>
    <option value="9000" {{ old('price', $article->price) == 9000 ? 'selected' : '' }}>9000</option>
    <option value="10000" {{ old('price', $article->price) == 10000 ? 'selected' : '' }}>10000</option>
  </select>
</td>
                    <td>
                    <select name="situation" class="form-control" required>
  <option value="掲載中" {{ old('situation', $article->situation) === '掲載中' ? 'selected' : '' }}>掲載中</option>
  <option value="進行中" {{ old('situation', $article->situation) === '進行中' ? 'selected' : '' }}>進行中</option>
  <option value="完了" {{ old('situation', $article->situation) === '完了' ? 'selected' : '' }}>完了</option>
</select>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="text-center mt-3">
  <!-- 戻るボタン -->
  <button type="button" class="btn btn-secondary" onClick="history.back()" style="width: 150px;">戻る</button>

  <!-- 更新ボタン -->
  <button type="submit" class="btn btn-primary ml-3" style="width: 150px;">
    更新
  </button>
</div>
</form> <!-- 更新フォーム終了 -->

<!-- 削除フォーム -->
<form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline" class="mt-3">
  @csrf
  @method('DELETE')
  <div class="text-center">
    <button type="submit" class="btn btn-danger" style="width: 150px;" onclick="return confirm('本当に削除しますか？')">
      削除
    </button>
  </div>
</form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
