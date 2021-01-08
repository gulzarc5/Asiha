<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{

    protected $table = 'colors';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name','color','status','category_id','sub_category_id'
    ];


    public function subCategory(){
        return $this->belongsTo('App\Models\SubCategory','sub_category_id',$this->primaryKey);
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id',$this->primaryKey);
    }

    public function productCount($category_id = null,$type = null)
    {
        return $this->hasMany('App\Models\ProductColor','color_id',$this->primaryKey);
    }
    // public function subCategory()
    // {
    //     return $this->hasMany('App\Models\Category','parent_id',$this->primaryKey);
    // }

    // public function productSubCategory()
    // {
    //     return $this->hasMany('App\Models\Product','sub_category_id',$this->primaryKey);
    // }
}
