<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // CSRFトークンを取得
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Ajaxのデフォルト設定にCSRFトークンを追加
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        $('.like-button').on('click', function() {
            console.log('Button clicked');  // クリック時にこのメッセージが表示されるか確認

            var $this = $(this);
            var article_id = $this.data('article-id');  // 修正: data-article-idを取得
            var isLiked = $this.data('liked');  // 修正: いいねの状態を取得

            console.log('Article ID:', article_id);  // コンソールにIDを表示

            // POSTリクエストのURLを名前付きルートで生成
            var url = isLiked 
                ? "{{ route('unlike', ['article' => '__article_id__']) }}" 
                : "{{ route('like', ['article' => '__article_id__']) }}";
            
            // article_idをURLに埋め込む
            url = url.replace('__article_id__', article_id);

            // Ajaxリクエスト
            $.ajax({
                url: url, // 生成したURLを使用
                type: isLiked ? 'DELETE' : 'POST', // isLikedに応じてPOSTまたはDELETE
                dataType: 'json',
                data: { article_id: article_id },
                success: function(response) {
                    console.log('Ajax Success');  // 成功した場合のログ

                    // UIの更新（いいねの状態を反転）
                    if (isLiked) {
                        $this.text('♡');  // いいねを外す
                    } else {
                        $this.text('♥');  // いいねをつける
                    }

                    // likedの状態を切り替え
                    $this.data('liked', !isLiked);
                },
                error: function(xhr, status, error) {
                    console.error('Ajax Error:', error);  // エラー時のログ
                    console.log('Request URL:', url);  // URLの確認
                    console.log('Request Data:', { article_id: article_id });  // 送信データの確認
                }
            });
        });
    });
</script>
