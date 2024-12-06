@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">案件投稿</div>
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

                    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">名前</label>
                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-2 col-form-label text-md-right">画像</label>
                            <div class="col-md-9">
                                <input id="image" type="file" class="form-control" name="image">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label text-md-right">タイトル</label>
                            <div class="col-md-9">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-2 col-form-label text-md-right">価格</label>
                            <div class="col-md-9">
                                <select id="price" class="form-control" name="price" required>
                                    <option value="" disabled selected>価格を選択してください</option>
                                    <option value="1000">1,000円</option>
                                    <option value="2000">2,000円</option>
                                    <option value="3000">3,000円</option>
                                    <option value="4000">4,000円</option>
                                    <option value="5000">5,000円</option>
                                    <option value="10000">10,000円</option>
                                </select>
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-2 col-form-label text-md-right">ステータス</label>
                            <div class="col-md-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="open" name="status" value="0" checked>
                                    <label class="form-check-label" for="open">公開</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="private" name="status" value="1">
                                    <label class="form-check-label" for="private">未公開</label>
                                </div>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="content" class="col-md-2 col-form-label text-md-right">本文</label>
                            <div class="col-md-9">
                                <textarea name="body" id="body" class="form-control" style="resize: none; height: 200px;" required>{{ old('body') }}</textarea>
                                @error('body')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 d-flex justify-content-center">
                                <button type="button" class="btn btn-secondary" onClick="history.back()">戻る</button>
                                <button type="submit" class="btn btn-primary ml-3">
                                    投稿
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
