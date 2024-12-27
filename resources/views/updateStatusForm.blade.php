@extends('layouts.app')

@section('content')
    <h1 class="text-center mb-4">ユーザー一覧</h1>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>名前</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> 
@endsection