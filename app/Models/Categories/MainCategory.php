<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{

    //protected $table = 'main_category';


    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category'
    ];

    // SubCategoryとのリレーション
    public function subCategory(){
        return $this->hasMany('App\Models\Categories\SubCategory');
    }

    //Postモデルとのリレーション
    public function posts()
    {
        return $this->hasMany('App\Models\Posts\Post');
    }

    public function mainCategoryId(Int $sub_category_id)
    {
            return $this->main_category()->attach($id);
    }
}
