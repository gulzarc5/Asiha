<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id','shipping_address_id', 'discount', 'amount','shipping_charge','total_amount','payment_request_id', 'payment_id','payment_type','payment_status','order_status','refund_request','order_status_updated_by',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id',$this->primaryKey);
    }

    public function shippingAddress()
    {
        return $this->belongsTo('App\Models\Address','shipping_address_id',$this->primaryKey);
    }

    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetalis','order_id',$this->primaryKey);
    }
}
