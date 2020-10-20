<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetalis extends Model
{
    protected $table = 'order_details';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 'order_id', 'product_id', 'size','color','quantity','price','mrp','discount','order_status','refund_request','refund_amount'
    ];

    public function order()
    {
        return $this->belongsTo('App\Models\Order','order_id',$this->primaryKey);
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id',$this->primaryKey);
    }

    public function refund()
    {
        return $this->hasOne('App\Models\RefundInfo','order_id',$this->primaryKey);
    }
}
