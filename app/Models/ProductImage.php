<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;

class ProductImage extends Model
{
    use LaratrustUserTrait;
    protected $table = 'product_image';
    protected $primaryKey = 'id';
    protected $fillable = [
        'image', 'product_id',
    ];
}
