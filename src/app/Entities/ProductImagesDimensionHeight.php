<?php

namespace VCComponent\Laravel\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductImagesDimensionHeight extends Model
{
    protected $fillable =[
        'id',
        'value'
    ];

    public function productImagesDimension()
    {
        return $this->hasMany(ProductImagesDimension::class, 'dimension_height_id');
    }
}
