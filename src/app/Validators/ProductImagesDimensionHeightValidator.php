<?php

namespace VCComponent\Laravel\Product\Validators;

use VCComponent\Laravel\Vicoders\Core\Validators\AbstractValidator;

class ProductImagesDimensionHeightValidator extends AbstractValidator
{
    protected $rules = [
        'RULE_ADMIN_CREATE' => [
            'value' => ['required'],
        ],
        'RULE_ADMIN_UPDATE'  => [

        ]
    ];
}
