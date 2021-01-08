<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryImages extends Model
{
    protected $table='category_images';
    protected $primarykey = 'id';

    protected $fillable=[
        'category_id','image'
    ];
}
