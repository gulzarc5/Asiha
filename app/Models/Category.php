<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name','status','is_sub_category','image'
    ];

    public function subCategory()
    {
        return $this->hasMany('App\Models\Category','parent_id',$this->primaryKey);
    }

    public function productSubCategory()
    {
        return $this->hasMany('App\Models\Product','sub_category_id',$this->primaryKey);
    }
}
