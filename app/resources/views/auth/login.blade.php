@extends('layout')

@section('content')
  <h1 class="text-center mt-5 ">ログイン</h1>
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('login') }}" method="POST" class="mx-auto" style="max-width: 500px;>
              @csrf
              <div class="form-group ">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
              </div>
              <div class="form-group ">
                <label for="password">パスワード</label>
                <input type="password" class="form-control" id="password" name="password" />
              </div>
              <div class="text-right mt-1">
          <a href="{{ route('password.request') }}">パスワードを忘れた方はこちらから</a>
        </div>
              <div class="text-center mt-4 ">
                <button type="submit" class="btn btn-primary">ログイン</button>
              </div>
            </form>
          </div>
        </nav>
        <div class="text-center mt-3">
          <a href="{{ route('register')}}">新規登録はこちらから</a>
        </div>
      </div>
    </div>
  </div>
@endsection