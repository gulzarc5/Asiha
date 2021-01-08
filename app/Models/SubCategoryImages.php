<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategoryImages extends Model
{
    protected $table='subcategory_images';
    protected $primarykey = 'id';

    protected $fillable=[
        'sub_category_id','image'
    ];
}
