@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <h1 class="text-center mb-4">アカウント情報編集</h1>

                    <!-- フォーム開始 -->
                    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- アラート表示 (成功時) -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- ①アイコン画像 -->
                        <div class="form-group text-center">
                            <label for="image" class="form-label">アイコン画像</label>
                            <br>
                            <img src="{{ $user->image }}" alt="現在のアイコン画像" class="rounded-circle mb-2" style="width: 100px; height: 100px;">
                            <input type="file" class="form-control-file mt-2" id="image" name="image">
                            @error('icon') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- ②氏名 -->
                        <div class="form-group">
                            <label for="name" class="form-label">氏名</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- ③メールアドレス -->
                        <div class="form-group">
                            <label for="email" class="form-label">メールアドレス</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- ④自己紹介・詳細 -->
                        <div class="form-group">
                            <label for="profile" class="form-label">自己紹介・詳細</label>
                            <textarea class="form-control" id="profile" name="profile" rows="5">{{ old('profile', $user->profile) }}</textarea>
                            @error('details') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <!-- ⑤戻る & ⑥確認へ -->
                        <div class="form-actions d-flex justify-content-between mt-4">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
                            <button type="submit" class="btn btn-primary">反映</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
