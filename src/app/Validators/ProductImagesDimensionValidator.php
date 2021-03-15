<?php

namespace VCComponent\Laravel\Product\Validators;

use VCComponent\Laravel\Vicoders\Core\Validators\AbstractValidator;

class ProductImagesDimensionValidator extends AbstractValidator
{
    protected $rules = [
        'RULE_ADMIN_CREATE' => [
            'product_images_dimension_name_id'   => ['required'],
            'product_images_dimension_type_id'   => ['required'],
            'product_images_dimension_width_id'  => ['required'],
            'product_images_dimension_height_id' => ['required'],
            'product_type'                       => ['required']
        ],
        'RULE_ADMIN_UPDATE'  => [

        ]
    ];
}
