<?php

namespace VCComponent\Laravel\Product\Transformers;

use League\Fractal\TransformerAbstract;

class ProductImagesDimensionTypeTransformer extends TransformerAbstract
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
            'id'   => $model->id,
            'type' => $model->type,
        ];
    }
}
