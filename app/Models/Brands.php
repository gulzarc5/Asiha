<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brands  extends Model
{

    protected $table = 'brands';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name','status','image','sub_category_id','category_id'
    ];

    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory','sub_category_id',$this->primaryKey);
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id',$this->primaryKey);
    }
}
