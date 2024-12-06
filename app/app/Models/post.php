<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // リレーション設定: 投稿はユーザーに属する
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
