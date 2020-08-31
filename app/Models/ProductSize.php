<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;

class ProductSize extends Model
{    
    use LaratrustUserTrait;
    protected $table = 'product_sizes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'product_id','mrp', 'price','min_ord_quantity','stock',
    ];

}
