@extends('layouts.app')

@section('content') 
<div class="d-flex flex-column justify-content-start" style="min-height: 100vh; padding-top: 20px;">
  <div class="container">
    <h1 class="text-center mb-5">ログイン</h1>
    @if($errors->any())
      <div class="alert alert-danger">
        @foreach($errors->all() as $message)
          <p>{{ $message }}</p>
        @endforeach
      </div>
    @endif

    <form action="{{ route('login') }}" method="POST" class="mx-auto" style="max-width: 500px;">
      @csrf
      <div class="form-group">
        <label for="email">メールアドレス</label>
        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
      </div>

      <div class="form-group">
        <label for="password">パスワード</label>
        <input type="password" class="form-control" id="password" name="password" />
      </div>

      <div class="form-group row">
        <div class="col-md-6 offset-md-4">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
              次回から自動で入力する
            </label>
          </div>
        </div>
      </div>

      <div class="text-right mt-1">
        <a href="{{ route('password.request') }}">パスワードを忘れた方はこちらから</a>
      </div>

      <div class="text-right mt-1">
        <a href="{{ route('guest.login')  }}">ゲストでの使用はこちら</a>
      </div>



      <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary">ログイン</button>
      </div>
    </form>

    <div class="text-center mt-3">
       <a href="{{ route('register') }}">新規登録はこちらから</a> 
    </div>
  </div>
</div>
@endsection

