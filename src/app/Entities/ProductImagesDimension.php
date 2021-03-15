<?php

namespace VCComponent\Laravel\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductImagesDimension extends Model
{
    protected $fillable = [
        'id',
        'dimension_name_id',
        'dimension_type_id',
        'dimension_width_id',
        'dimension_height_id',
        'product_type',
    ];

    public function productImagesDimensionName()
    {
        return $this->belongsTo(ProductImagesDimensionName::class);
    }

    public function productImagesDimensionType()
    {
        return $this->belongsTo(ProductImagesDimensionType::class);
    }

    public function productImagesDimensionWidth()
    {
        return $this->belongsTo(ProductImagesDimensionWidth::class);
    }

    public function productImagesDimensionHeight()
    {
        return $this->belongsTo(ProductImagesDimensionHeight::class);
    }

    public function scopeOfProductType($query, $product_type)
    {
        return $query->where('product_type', $product_type);
    }
}
