@extends('layouts.app') 

@section('content') 

<div class="container mt-4">
    <h1 class="text-center mb-4">管理ユーザー専用画面（違反投稿リスト）</h1>

    <!-- 検索フォーム -->
    <form method="GET" action="{{ route('owner_users.index') }}" class="mb-3">
    <!-- <form method="GET" action="{{ route('ownerpage.suspend') }}" class="mb-3">  -->
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
    <table class="table table-bordered text-center " style="min-width: 1200px;">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>報告ユーザーID</th>
                <th>報告ユーザー名</th>
                <th>案件ID</th>
                <th>報告件数</th>
                <th>現状ステータス</th>
                <th>報告理由</th>
                <th>違反対応</th>
            </tr>
        </thead>
        <tbody>
            @php
                $postCounts = [];
                foreach ($reports as $report) {
                    $postCounts[$report->post_id] = ($postCounts[$report->post_id] ?? 0) + 1;
                }
            @endphp

            <!-- @forelse ($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->user->id ?? '-' }}</td>
                    <td>{{ $report->user->name ?? '未登録' }}</td>
                    <td>{{ $report->post_id }}</td>
                    <td>{{ $postCounts[$report->post_id] ?? 0 }}</td> 報告回数を表示
                    <td>{{ $report->post->situation ?? '未設定' }}</td>
                    <td>{{ $report->reason }}</td>

                    <td>
                        <form method="POST" action="{{ route('update_status', $report->post_id) }}">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="form-control" onchange="this.form.submit()">
                                 <option value="通常" {{ $report->post->status === '通常' ? 'selected' : '' }}>通常</option> 
                                <option value="停止" {{ $report->post->status === '停止' ? 'selected' : '' }}>停止</option>
                                <option value="削除" {{ $report->post->status === '削除' ? 'selected' : '' }}>削除</option>
                            </select>
                        </form>
                    </td>
                    
                </tr>
            @empty
                <tr>
                    <td colspan="8">報告はありません。</td>
                </tr>
            @endforelse -->

            @forelse ($reports as $report)
    <tr>
        <td>{{ $report->id }}</td>
        <td>{{ $report->user->id ?? '-' }}</td>
        <td>{{ $report->user->name ?? '通常' }}</td>
        <td>{{ $report->post_id }}</td>
        <td>{{ $postCounts[$report->post_id] ?? 0 }}</td> <!-- 報告回数を表示 -->
        <td>{{ $report->post->situation ?? '通常' }}</td>
        <td>{{ $report->reason }}</td>

        <td>
            <form method="POST" action="{{ route('update_status', $report->post_id) }}">
                @csrf
                @method('PATCH')
                <select name="status" class="form-control" onchange="this.form.submit()">
                    <option value="通常" {{ $report->post->status === '通常' ? 'selected' : '' }}>通常</option> 
                    <option value="停止" {{ $report->post->status === '停止' ? 'selected' : '' }}>停止</option>
                    <option value="削除" {{ $report->post->status === '削除' ? 'selected' : '' }}>削除</option>
                </select>
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
@endsection
