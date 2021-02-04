<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'fb_products';

    protected $fillable = [
        'extern_id',
        'code_id',
        'group_id',
        'mountedon_id',                         //BRAND
        'supplier_id',
        'replacement_for_id',                   //BRAND

        'current',
        'delivery_from',
        'description',
        'details',
        'info',
        'kw',
        'customer_price_code',
        'oem_number',
        'power',
        'price',
        'price_old',
        'features',
        'pulley_details',
        'pulley_type',
        'rotation',
        'stock',
        'teeth',
        'voltage'
    ];

    public function code()
    {
        return $this->belongsTo(ProductCode::class);
    }

    public function supplier()
    {
        return $this->belongsTo(ProductSupplier::class);
    }

    public function group()
    {
        return $this->belongsTo(ProductGroup::class);
    }

    public function mounton()
    {
        return $this->belongsTo(ProductMountOn::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function replacements()
    {
        return $this->hasMany(ProductReplacement::class);
    }

}
