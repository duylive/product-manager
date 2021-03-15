<?php

namespace VCComponent\Laravel\Product\Traits;

use VCComponent\Laravel\Product\Entities\ProductImagesDimensionName;
use VCComponent\Laravel\Product\Entities\ProductImagesDimensionType;
use VCComponent\Laravel\Product\Entities\ProductImagesDimensionWidth;
use VCComponent\Laravel\Product\Entities\ProductImagesDimensionHeight;

trait ProductImagesDimensionTrait
{
    public function productTypes()
    {
        return [];
    }

    public function productImagesDimensionName()
    {
        return $this->hasOne(ProductImagesDimensionName::class);
    }

    public function productImagesDimensionType()
    {
        return $this->hasOne(ProductImagesDimensionType::class);
    }

    public function productImagesDimensionWidth()
    {
        return $this->hasOne(ProductImagesDimensionWidth::class);
    }

    public function productImagesDimensionHeight()
    {
        return $this->hasOne(ProductImagesDimensionHeight::class);
    }
}
