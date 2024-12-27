<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

// 　いいね機能
    public function likes()
    {
        return $this->hasMany(Like::class);
    }




    // 管理者判定
public function isAdmin(): bool
{
    return $this->role === 0;
}

// 一般ユーザー判定
public function isGeneralUser(): bool
{
    return $this->role === 2;
}

// 未ログインユーザー判定
public function isGuestUser(): bool
{
    return $this->role === 1;
}


public function articles()
    {
        return $this->hasMany(Article::class, 'user_id');
    }



    
}

    

