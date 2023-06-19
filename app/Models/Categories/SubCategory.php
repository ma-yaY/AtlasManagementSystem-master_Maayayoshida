<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{



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

    //postとのリレーション
    public function posts(){
        return $this->belongsToMany('App\Models\Posts\Post','post_sub_categories', 'sub_category_id', 'post_id');// リレーションの定義;
    }

    //ユーザーの投稿とサブカテゴリーを繋ぐ処理
    public function categoriesIds(Int $id)
  {

    $sub_category_id[] = $id;
      return $this->where('sub_category_id', $id)->get();
  }

}
