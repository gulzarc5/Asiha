<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;

class Order extends Model
{
    use LaratrustUserTrait;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 'total_quantity', 'total_discount','total_price','payment_request_id','payment_status','order_status','order_status_updated_by',
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id',$this->primaryKey);
    }
}
