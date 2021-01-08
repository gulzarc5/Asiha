<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductSize;

class Cart extends Model
{
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 'product_id', 'size_id','color','quantity',
    ];

    public function sizes()
    {
        return $this->belongsTo('App\Models\ProductSize','size_id','id');
    }

    public function colors()
    {
        return $this->belongsTo('App\Models\Color','color',$this->primaryKey);
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id',$this->primaryKey);
    }
}
