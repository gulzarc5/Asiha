<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThirdCategory  extends Model
{

    protected $table = 'third_category';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name','slug','status','image','sub_category_id'
    ];

    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory','sub_category_id',$this->primaryKey);
    }

    public function productCount()
    {
        return $this->hasMany('App\Models\Product','last_category_id',$this->primaryKey);
    }

    public function thirdLevelCategoryImages()
    {
        return $this->hasMany('App\Models\thirdLevelCategoryImages','third_category_id',$this->primaryKey);
    }
}
