@extends('layouts.app')

@section('content') 

<div class="container">
    <h1>ユーザー停止された方の違反数一覧</h1>
  
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="background-color: black; color: white;">停止処理ID</th>
                <th style="background-color: black; color: white;">ユーザーID</th>
                <th style="background-color: black; color: white;">名前</th>
                <th style="background-color: black; color: white;">ステータス</th>
                <th style="background-color: black; color: white;">処理日</th>
                <th style="background-color: black; color: white;">記事の削除・停止数</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->user_id }}</td>
                    <td>{{ $report->user_name }}</td>
                    <td>{{ $report->status }}</td>
                    <td>{{ $report->created_at }}</td>
                    <td>{{ $report->article_count }}</td> 
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
