<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;

class ProductSpecification extends Model
{
    use LaratrustUserTrait;
    protected $table = 'product_specification';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_id','name', 'value', 
    ];
}
