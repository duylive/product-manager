<?php

namespace VCComponent\Laravel\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductImagesDimensionName extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];

    public function productImagesDimension()
    {
        return $this->hasMany(ProductImagesDimension::class, 'dimension_name_id');
    }
}
