<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;

class OrderDetalis extends Model
{
    use LaratrustUserTrait;
    protected $table = 'order_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 'order_id', 'product_id', 'size_id','quantity','price','total_discount','total_amount',
    ];

    // public function sizes()
    // {
    //     return $this->belongsTo('App\Models\ProductSize','size_id',$this->primaryKey);
    // }
}
