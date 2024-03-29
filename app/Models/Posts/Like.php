<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Posts\Post;


class Like extends Model
{
    const UPDATED_AT = null;

    protected $fillable = [
        'like_user_id',
        'like_post_id'
    ];

    public function users(){
        return $this->belongsToMany('App\Models\Users\User', 'likes', 'like_post_id', 'like_user_id');
    }

    // Postとのリレーション
    public function Post()
    {
        return $this->belongsTo('App\Models\Posts\Post');
    }


    public function likeCounts($post_id){
        return $this->where('like_post_id', $post_id)->get()->count();
        //既にカウントしている。bladeでlike_post_id,$post_idとして変換する値を送る指示を出す。

    }
}
