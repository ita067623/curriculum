@extends('layouts.app')

@section('content') 

<div class="container">
    <h1>ユーザー 一覧</h1>
  
    <table class="table table-bordered">
        <thead>
            <tr>
               
                <th style="background-color: black; color: white;">ユーザーID</th>
                <th style="background-color: black; color: white;">名前</th>
                <th style="background-color: black; color: white;">停止(4)</th>
                <!-- <th style="background-color: black; color: white;">処理日</th> -->
                <th style="background-color: black; color: white;">記事の削除・停止数</th> 
                <th style="background-color: black; color: white;">停止ボタン</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->name }}</td>
                    <td>{{ $report->role }}</td>
                    <!-- <td>{{ $report->created_at }}</td> -->
                    <td>{{ $report->article_count }}</td> 
                    <td>
                        @if($report->role != 4)
                            <form action="{{ route('users.updateRole', ['id' => $report->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-warning">停止に変更</button>
                            </form>
                        @else
                            停止中
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
       <!-- ページネーションリンク -->
       <div class="d-flex justify-content-center">
        {{ $reports->links() }}
</div>

@endsection
