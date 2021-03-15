<?php

namespace VCComponent\Laravel\Product\Validators;

use VCComponent\Laravel\Vicoders\Core\Validators\AbstractValidator;

class ProductImagesDimensionTypeValidator extends AbstractValidator
{
    protected $rules = [
        'RULE_ADMIN_CREATE' => [
            'type' => ['required'],
        ],
        'RULE_ADMIN_UPDATE'  => [

        ]
    ];
}
