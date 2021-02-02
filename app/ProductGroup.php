<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    protected $table = 'fb_product_groups';

    protected $fillable = ['name'];



    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
