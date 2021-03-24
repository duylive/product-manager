<?php

namespace VCComponent\Laravel\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductMediaDimension extends Model
{
    protected $fillable = [
        'id',
        'media_id',
        'product_images_dimension_id',
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function productImagesDimension()
    {
        return $this->belongsTo(ProductImagesDimension::class);
    }
}
