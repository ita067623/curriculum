@extends('layouts.app')

@section('content')
<div class="container">
    <h2>登録完了</h2>
    <p>ご登録ありがとうございます。</p>
    <a href="{{ route('articles.index') }}" class="btn btn-primary">ホームへ戻る</a>
</div>
@endsection

