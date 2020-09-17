<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{

    protected $table = 'sizes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name','status','category_id','sub_category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id',$this->primaryKey);
    }

    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory','sub_category_id',$this->primaryKey);
    }
}
