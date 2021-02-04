<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'fb_product_images';

    protected $fillable = [
        'product_id',
        'type',
        'link'
    ];



    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
