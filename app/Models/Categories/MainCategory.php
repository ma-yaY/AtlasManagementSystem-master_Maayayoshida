<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{

    protected $table = 'post_mainCategories';


    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category'
    ];

    public function subCategories(){
        return $this->hasMany('App\Models\Posts\SubCategory');
    }

    //
    public function mainCategoryId(Int $PostSubCategory_id)
    {
            return $this->post_mainCategories()->attach($id);
    }
}
