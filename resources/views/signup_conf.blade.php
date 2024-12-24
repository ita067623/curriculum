@extends('layouts.app')

@section('content')
<div class="container">
    <h2>入力確認</h2>
    <form action="{{ 'register.store') }}" method="POST">
        @csrf
        <input type="hidden" name="email" value="{{ $data['email'] }}">
        <input type="hidden" name="name" value="{{ $data['name'] }}">
        <input type="hidden" name="password" value="{{ $data['password'] }}">

        <p>メールアドレス: {{ $data['email'] }}</p>
        <p>名前: {{ $data['name'] }}</p>
        <p>パスワード: ********</p>

        <button type="submit" class="btn btn-primary">登録する</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection

