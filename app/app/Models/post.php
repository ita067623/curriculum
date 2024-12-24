<?php



use Illuminate\Database\Eloquent\Model;


class Report extends Model
{
    protected $fillable = ['user_id', 'post_id', 'reason'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Article::class, 'post_id');
    }
}