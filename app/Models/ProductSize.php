<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{    
    protected $table = 'product_sizes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'size_id', 'product_id','mrp', 'price','stock',
    ];

    public function size()
    {
        return $this->belongsTo('App\Models\Size','size_id',$this->primaryKey);
    }

}
