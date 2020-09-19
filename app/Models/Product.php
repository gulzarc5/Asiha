<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;

class Product extends Model
{
    use LaratrustUserTrait;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name','category_id','sub_category_id','sub_category_id','main_image','description','min_price','mrp','stock','status ',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Categories','category_id',$this->primaryKey);
    }

    public function subCategory()
    {
        return $this->belongsTo('App\Models\Categories','sub_category_id',$this->primaryKey);
    }

    public function sizes()
    {
        return $this->hasMany('App\Models\ProductSize','product_id',$this->primaryKey);
    }

    public function minSize()
    {
        return $this->hasMany('App\Models\ProductSize','product_id',$this->primaryKey)
        ->where('product_sizes.customer_price',$this->sizes->min('customer_price'));
    }


    public function specifications()
    {
        return $this->hasMany('App\Models\ProductSpecification','product_id',$this->primaryKey);
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductImage','product_id',$this->primaryKey);
    }
}
