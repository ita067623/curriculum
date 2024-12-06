@extends('layout')

@section('content')
<div class="container mt-5">
    <style>
        .container {
            max-width: 700px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-control {
            margin-bottom: 20px;
            border-radius: 5px;
            padding: 10px;
        }
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn {
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            border-radius: 5px;
            display: inline-block;
        }
        .btn-secondary {
            background-color: gray;
        }
        .btn-primary {
            background-color: orange;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>

    <h1 class="text-center mb-4">依頼内容入力</h1>
    <form action="{{ route('request.confirm') }}" method="POST">
        @csrf

        <!-- ①依頼内容のタイトル -->
        <div class="form-group">
            <label for="title">依頼内容のタイトル</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="タイトルを入力" required>
        </div>

        <!-- ②金額 -->
        <div class="form-group">
            <label for="amount">金額</label>
            <input type="number" id="amount" name="amount" class="form-control" placeholder="金額を入力" required>
        </div>

        <!-- ③希望納期 -->
        <div class="form-group">
            <label for="deadline">希望納期</label>
            <input type="date" id="deadline" name="deadline" class="form-control" required>
        </div>

        <!-- ④電話番号 -->
        <div class="form-group">
            <label for="phone">電話番号</label>
            <input type="tel" id="phone" name="phone" class="form-control" placeholder="電話番号を入力" required>
        </div>

        <!-- ⑤メールアドレス -->
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="メールアドレスを入力" required>
        </div>

        <!-- ⑥依頼内容詳細 -->
        <div class="form-group">
            <label for="details">依頼内容詳細</label>
            <textarea id="details" name="details" class="form-control" rows="5" placeholder="依頼内容の詳細を入力" required></textarea>
        </div>

        <!-- ⑦戻る & ⑧確認へ -->
        <div class="form-actions">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-primary">確認へ</button>
        </div>
    </form>
</div>
@endsection
