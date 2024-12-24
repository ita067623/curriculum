<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

use App\User; 
use App\Models\Report;

class UserReport extends Model
{
   

    protected $fillable = ['user_id','status'];

    // ユーザーとのリレーション
    public function reportedUser()
    {
        return $this->belongsTo(User::class);
    }

    // 報告者とのリレーション
    public function reporter()
    {
        return $this->belongsTo(Report::class);
    }
}