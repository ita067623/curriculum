<?php
namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Article;

class Report extends Model
{
   

    // モデルで使用するカラムを指定
    protected $fillable = [
        'user_id',
        'post_id',
        'reason',
    ];

    // リレーションの定義（必要に応じて）
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Article::class);
    }
}
