<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{

    //protected $table = 'post_subCategories';

    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category_id',
        'sub_category',
    ];

    // mainCategoryとのリレーション
    public function mainCategories(){
        return $this->belongsTo('App\Models\Categories\MainCategory');
    }

    public function posts(){
        return $this->hasMany('App\Models\Posts\Post');
    }

    //ユーザーの投稿とサブカテゴリーを繋ぐ処理
    public function categoriesIds(Int $id)
  {

    $category_id[] = $id;
      return $this->where('category_id', $id)->get();
  }

}
