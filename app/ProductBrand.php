<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    protected $table = 'fb_product_brands';

    protected $fillable = ['name'];



    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function replacements()
    {
        return $this->hasMany(Product::class);
    }
}
