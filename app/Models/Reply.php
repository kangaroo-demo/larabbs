<?php

namespace App\Models;

class Reply extends Model
{
    //允许修改的字段
    protected $fillable = ['content'];

    //一个回复属于一个帖子
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    //一个回复属于一个用户
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
