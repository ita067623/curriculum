@extends('layouts.app')

@section('content') 

<div class="container mt-5">
    <h1 class="text-center mb-4">管理ユーザー専用画面（違反投稿者処理画面）</h1>

    <!-- 検索フォーム -->
    <form method="GET" action="{{ route('ownerpage.suspend') }}" class="mb-3">
        <div class="row align-items-center">
            <div class="col-md-4">
      
            </div> 
            <div class="col-md-4">
                <select name="sort" class="form-control" onchange="this.form.submit()">
                    <option value="id" {{ $sort === 'id' ? 'selected' : '' }}>ユーザーID順</option>
                    <option value="reports_count" {{ $sort === 'reports_count' ? 'selected' : '' }}>報告件数順</option>
                </select>
            </div>
        </div>
    </form>

    <!-- ユーザーデータ一覧 -->
    <table class="table table-bordered text-center" style="min-width: 1200px;">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>違反ユーザーID</th>
                <th>違反ユーザー名</th>
                <th>違反案件ID</th>
                <th>報告件数</th>
                <th>ステータス</th>
                <th>報告理由</th>
                <!-- <th>状態</th> -->
                <th>停止登録</th>
               
            </tr>
        </thead>
        
        

<tbody>
@php
    $postCounts = [];
    foreach ($reports as $report) {
        $postCounts[$report->post_id] = ($postCounts[$report->post_id] ?? 0) + 1;
    }
@endphp

@forelse ($reports as $report)
    <tr>
        <td>{{ $report->id }}</td>
        <td>{{ $report->user->id ?? '-' }}</td>
        <td>{{ $report->user->name ?? '未登録' }}</td>
        <td>{{ $report->post_id }}</td>
        <td>{{ $postCounts[$report->post_id] ?? 0 }}</td> <!-- 報告回数を表示 -->
        <td>{{ $report->post->situation ?? '未設定' }}</td>
        <td>{{ $report->reason }}</td>
        <!-- <td> -->
                <!-- 状態のプルダウン -->
                <!-- <form method="POST" action="{{ route('owner_users.update_status', $report->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="suspended">
                        <!-- 隠しフィールドとして user_id を追加 -->
    <input type="hidden" name="user_id" value="{{ $report->user_id }}">
                    <!-- <select name="status" class="form-control" onchange="this.form.submit()">
                    <option value="" disabled selected>選択してください</option> 
                        <option value="解決済み" {{ $report->status === '解決済み' ? 'selected' : '' }}>解決済み</option> -->
                        <!-- <option value="停止" {{ $report->status === '停止' ? 'selected' : '' }}>停止</option> -->
                        <!-- <option value="削除" {{ $report->status === '削除' ? 'selected' : '' }}>削除</option> -->
                    <!-- </select>
                </form>
            </td>  -->
            <td> 
                <!-- データ登録ボタン -->
    <form method="POST" action="{{ route('owner_users.register_status', $report->id) }}">
        @csrf
        <input type="hidden" name="user_id" value="{{ $report->user_id }}">
        <input type="hidden" name="status" value="default"> <!-- デフォルトステータス -->
        <button type="submit" class="btn btn-primary">停止登録</button>
    </form>
            </td>
    </tr>
@empty
    <tr>
        <td colspan="8">報告はありません。</td>
    </tr>
@endforelse
        </tbody>

    </table>

      <!-- ページネーション -->
    <div class="d-flex justify-content-center">
    {{ $reports->links() }}
</div>


    <!-- フッターボタン -->
    <div class="mt-4">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">戻る</a>
        <!-- <a href="ownerpage_delete.php" class="btn btn-danger float-right">ユーザー停止・削除ページへ</a> -->
    </div>
</div>


 <!-- フッター -->
 <!-- <footer class="mt-auto bg-dark text-white text-center py-3">
        <p class="mb-0">© 2024 管理者ページ</p>
    </footer>
</div> -->



@endsection





