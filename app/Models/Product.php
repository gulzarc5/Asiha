<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name','category_id','sub_category_id','last_category_id','brand_id','main_image','min_price','mrp','short_description','description','size_chart','status'
    ];


    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id',$this->primaryKey);
    }

    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory','sub_category_id',$this->primaryKey);
    }

    public function thirdCategory()
    {
        return $this->belongsTo('App\Models\ThirdCategory','last_category_id',$this->primaryKey);
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brands','brand_id',$this->primaryKey);
    }

    public function sizes()
    {
        return $this->hasMany('App\Models\ProductSize','product_id',$this->primaryKey);
    }

    // public function minSize()
    // {
    //     return $this->hasMany('App\Models\ProductSize','product_id',$this->primaryKey)
    //     ->where('product_sizes.customer_price',$this->sizes->min('customer_price'));
    // }


    public function productColors()
    {
        return $this->hasMany('App\Models\ProductColor','product_id',$this->primaryKey);
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductImage','product_id',$this->primaryKey);
    }
}
