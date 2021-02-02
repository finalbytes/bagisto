<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCode extends Model
{
    protected $table = 'fb_product_codes';

    protected $fillable = ['name'];



    public function product()
    {
        return $this->hasOne(Product::class);
    }
}
