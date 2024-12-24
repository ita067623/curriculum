@extends('layouts.appreport')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- 違反報告フォーム -->
<div class="card mt-4">
    <div class="card-header bg-danger text-white">
        違反報告フォーム
    </div>
    <div class="card-body">
        <form action="{{ route('reports.store') }}" method="POST">
            @csrf
             <input type="hidden" name="post_id" value="{{ $article->id }}"> 
             <input type="hidden" name="user_id" value="{{ $user->id }}"> 



            <div class="form-group">
        <label for="title">依頼内容のタイトル</label>
        <h2 class="h5 mb-1">{{ $article->title }}</h2>
    </div>
            
            <div class="mb-3">
                <label for="reason" class="form-label">違反理由:</label>
                <textarea name="reason" id="reason" class="form-control" rows="4" placeholder="違反内容を入力してください" required></textarea>
            </div>
            
            <button type="submit" class="btn btn-danger">報告する</button>
        </form>
    </div>
</div>

@endsection


