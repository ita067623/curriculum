<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User; 

class Article extends Model
{
    // データベース
    protected $fillable = [
         'user_id', 'name', 'image', 'title', 'price', 'status', 'body','situation'
    ];
    



// いいね機能
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function isLikedBy(User $user)
    {
        return $this->likes->where('user_id', $user->id)->isNotEmpty();
    }


// 検索機能
    public function scopeSearchKeyword($query, $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('title', 'like', "%{$keyword}%")
              ->orWhere('body', 'like', "%{$keyword}%");
        });
    }


    // 記事の投稿者とのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reports()
{
    return $this->hasMany(Report::class); // 1つの記事に複数の報告があるリレーション
}

}

