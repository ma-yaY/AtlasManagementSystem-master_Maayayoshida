<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;

class Post extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = [
        'user_id',
        'post_title',
        'post',
    ];

    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }

    // Likeとのリレーション
    public function Like()
    {
        return $this->hasMany('App\Models\Posts\Like');
    }

    // PostCommentリレーション投稿に対してのコメント
    public function postComments(){
        return $this->hasMany('App\Models\Posts\PostComment');
    }

    // SubCategoryリレーション
    public function subCategories(){
        return $this->belongsTo('App\Models\Posts\SubCategory');
    }

    // コメント数
    public function commentCounts($post_id){
        return Post::with('postComments')->find($post_id)->postComments();
    }



}
