@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <style>
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 20px;
        }
        .warning-text {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
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
        .btn-danger {
            background-color: red;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>

    <h1>退会確認</h1>
    <p class="warning-text">この操作を行うと、アカウント情報およびすべてのデータが削除されます。</p>

    <form action="{{ route('user.delete') }}" method="POST">
        @csrf
        <div class="form-actions">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-danger">退会する</button>
        </div>
    </form>
</div>
@endsection
