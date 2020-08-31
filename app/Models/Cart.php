<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;

class Cart extends Model
{
    use LaratrustUserTrait;
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 'product_id', 'size_id','quantity',
    ];

    public function sizes()
    {
        return $this->belongsTo('App\Models\ProductSize','size_id',$this->primaryKey);
    }
}
