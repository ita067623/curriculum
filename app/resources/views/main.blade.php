@extends('layout2') <!-- 最上部に配置 -->

@section('content') <!-- layout2.blade.phpの@yield('content')に挿入 -->
<div class="container mt-4">
        <!-- 検索フォーム -->
        <div class="card p-4 mb-4">
            <h2 class="mb-3">案件検索</h2>
            <form action="post_search.php" method="GET">
                <!-- キーワード入力 -->
                <div class="mb-3">
                    <label for="keyword" class="form-label">①内容 OR タイトルキーワード入力</label>
                    <input type="text" id="keyword" name="keyword" class="form-control" placeholder="キーワードを入力">
                </div>
                <!-- 金額入力 -->
                <div class="mb-3">
                    <label for="price" class="form-label">②金額</label>
                    <select id="price" name="price" class="form-select">
                        <option value="">指定なし</option>
                        <option value="1000">1000円以下</option>
                        <option value="5000">5000円以下</option>
                        <option value="10000">10000円以下</option>
                    </select>
                </div>
                <!-- 検索ボタン -->
                <button type="submit" class="btn btn-primary">③検索</button>
            </form>
        </div>

        <!-- 案件表示 -->
        <div class="row">
            <!-- 案件カード -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">案件表示１</h5>
                        <p class="card-text">詳細情報１</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">案件表示２</h5>
                        <p class="card-text">詳細情報２</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">案件表示３</h5>
                        <p class="card-text">詳細情報３</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">案件表示４</h5>
                        <p class="card-text">詳細情報４</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">案件表示５</h5>
                        <p class="card-text">詳細情報５</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">案件表示６</h5>
                        <p class="card-text">詳細情報６</p>
                    </div>
                </div>
            </div>
        </div>

       <!-- ナビゲーション -->
<div class="d-flex justify-content-between mt-4">
    <a href="main.php" class="btn btn-secondary">④ホーム</a>
    <a href="post_search.php" class="btn btn-secondary">⑤探す</a>
    <a href="mypage.php" class="btn btn-secondary">⑥マイページ</a>
</div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection




