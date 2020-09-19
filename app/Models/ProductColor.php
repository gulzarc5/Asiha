<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{    
    protected $table = 'product_colors';
    protected $primaryKey = 'id';
    protected $fillable = [
        'color_id', 'product_id','status',
    ];

}
