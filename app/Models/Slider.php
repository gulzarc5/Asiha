<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table='slider';
    protected $primarykey = 'id';
    protected $fillable=[
     'variant_type','slider_type','image','status','third_category_id'
    ];


}
