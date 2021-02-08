<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSupplier extends Model
{
    protected $table = 'fb_product_suppliers';

    protected $fillable = ['name', 'abbr'];


    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
