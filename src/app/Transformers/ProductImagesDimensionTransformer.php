<?php

namespace VCComponent\Laravel\Product\Transformers;

use League\Fractal\TransformerAbstract;
use VCComponent\Laravel\MediaManager\Transformers\MediaTransformer;
use VCComponent\Laravel\Product\Transformers\ProductImagesDimensionNameTransformer;
use VCComponent\Laravel\Product\Transformers\ProductImagesDimensionTypeTransformer;

class ProductImagesDimensionTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'media',
        'dimensionName',
        'dimensionType',
    ];

    public function __construct($includes = [])
    {
        $this->setDefaultIncludes($includes);
    }

    public function transform($model)
    {
        return [
            'id'                               => $model->id,
            'product_images_dimension_name_id' => $model->name,
            'product_images_dimension_type_id' => $model->type,
            'product_images_dimension_width'   => $model->width,
            'product_images_dimension_height'  => $model->height,
            'product_type'                     => $model->product_type,
            'timestamps'     => [
                'created_at' => $model->created_at,
                'updated_at' => $model->updated_at,
            ],
        ];
    }

    public function includeMedia($model)
    {
        return $this->collection($model->media, new MediaTransformer());
    }

    public function includeDimensionName($model)
    {
        if($model->dimensionName) {
            return $this->item($model->dimensionName, new ProductImagesDimensionNameTransformer());
        }
    }

    public function includeDimensionType($model)
    {
        if($model->dimensionType) {
            return $this->item($model->dimensionType, new ProductImagesDimensionTypeTransformer());
        }
    }
}
