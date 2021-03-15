<?php

namespace VCComponent\Laravel\Product\Validators;

use VCComponent\Laravel\Vicoders\Core\Validators\AbstractValidator;

class ProductImagesDimensionNameValidator extends AbstractValidator
{
    protected $rules = [
        'RULE_ADMIN_CREATE' => [
            'name' => ['required'],
        ],
        'RULE_ADMIN_UPDATE'  => [

        ]
    ];
}
