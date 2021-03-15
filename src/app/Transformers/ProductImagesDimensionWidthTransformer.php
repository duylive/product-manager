<?php

namespace VCComponent\Laravel\Product\Transformers;

use League\Fractal\TransformerAbstract;

class ProductImagesDimensionWidthTransformer extends TransformerAbstract
{
    protected $availableIncludes = [

    ];

    public function __construct($includes = [])
    {
        $this->setDefaultIncludes($includes);
    }

    public function transform($model)
    {
        return [
            'id' => $model->id,
            'value' => $model->value,
        ];
    }
}
