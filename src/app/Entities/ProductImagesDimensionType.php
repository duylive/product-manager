<?php

namespace VCComponent\Laravel\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductImagesDimensionType extends Model
{
    protected $fillable = [
        'id',
        'type',
    ];

    public function productImagesDimension()
    {
        return $this->hasMany(ProductImagesDimension::class, 'dimension_type_id');
    }
}
