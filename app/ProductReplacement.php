<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductReplacement extends Model
{
    protected $table = 'fb_product_replacements';

    protected $fillable = [
        'product_id',
        'brand_id',
        'code_id'
    ];



    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
