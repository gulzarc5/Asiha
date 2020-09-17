<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThirdCategory  extends Model
{

    protected $table = 'third_category';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name','status','image','sub_category_id'
    ];

    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory','sub_category_id',$this->primaryKey);
    }
}
