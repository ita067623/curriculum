<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestContent extends Model
{
   

    // 対応するテーブル名
    protected $table = 'requests';

    // 自動的に挿入されるタイムスタンプを有効化
    public $timestamps = true;

    // ホワイトリスト形式で、保存を許可するカラムを指定
    protected $fillable = [
        'post_id',
        'user_id',
        'content',
        'phone_number',
        'email',
        'date',
    ];

    // $dates プロパティで日付型として扱うカラムを指定
    protected $dates = ['date', 'created_at', 'updated_at'];

    /**
     * リレーションシップの例: 関連する記事情報を取得
     */
    public function post()
    {
        return $this->belongsTo(Article::class, 'post_id');
    }

    /**
     * リレーションシップの例: 関連するユーザー情報を取得
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}