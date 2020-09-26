<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory  extends Model
{

    protected $table = 'sub_category';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name','slug','status','image','category_id','is_sub_category'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id',$this->primaryKey);
    }

    public function thirdCategory()
    {
        return $this->hasMany('App\Models\ThirdCategory','sub_category_id',$this->primaryKey);
    }

    public function productCount()
    {
        return $this->hasMany('App\Models\Product','sub_category_id',$this->primaryKey);
    }

    public function subCategoryImages()
    {
        return $this->hasMany('App\Models\SubCategoryImages','sub_category_id',$this->primaryKey);
    }
}
