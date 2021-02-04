<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    protected $table = 'fb_product_brands';

    protected $fillable = ['name'];



    public function productMountOns()
    {
        return $this->hasMany(Product::class);
    }

    public function productReplacements()
    {
        return $this->hasMany(Product::class);
    }
}
