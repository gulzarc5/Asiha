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
