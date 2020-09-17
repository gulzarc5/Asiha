<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{

    protected $table = 'sizes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name','status','category_id','sub_category_id'
    ];

    // public function subCategory()
    // {
    //     return $this->hasMany('App\Models\Category','parent_id',$this->primaryKey);
    // }

    // public function productSubCategory()
    // {
    //     return $this->hasMany('App\Models\Product','sub_category_id',$this->primaryKey);
    // }
}
