<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThirdLevelCategoryImages extends Model
{
    protected $table='third_level_category_images';
    protected $primarykey = 'id';

    protected $fillable=[
        'third_category_id','image'
    ];
    
}
