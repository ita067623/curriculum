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


}

