<?php

namespace VCComponent\Laravel\Product\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use VCComponent\Laravel\Product\Repositories\ProductImagesDimensionTypeRepository;
use VCComponent\Laravel\Product\Transformers\ProductImagesDimensionTypeTransformer;
use VCComponent\Laravel\Product\Validators\ProductImagesDimensionTypeValidator;

use VCComponent\Laravel\Vicoders\Core\Controllers\ApiController;

class ProductImagesDimensionTypeController extends ApiController
{
    protected $repository;
    protected $validator;

    public function __construct(ProductImagesDimensionTypeRepository $repository, ProductImagesDimensionTypeValidator $validator)
    {
        $this->repository  = $repository;
        $this->entity      = $repository->getEntity();
        $this->validator   = $validator;
        $this->transformer = ProductImagesDimensionTypeTransformer::class;

        if (config('product.auth_middleware.admin.middleware') !== '') {
            $this->middleware(
                config('product.auth_middleware.admin.middleware'),
                ['except' => config('product.auth_middleware.admin.except')]
            );
        }
    }

    public function index(Request $request )
    {
        $query = $this->entity;

        $query = $this->applyConstraintsFromRequest($query, $request);
        $query = $this->applySearchFromRequest($query, ['type'], $request);
        $query = $this->applyOrderByFromRequest($query, $request);

        $per_page   = $request->has('per_page') ? (int) $request->get('per_page') : 15;
        $schemas = $query->paginate($per_page);

        if ($request->has('includes')) {
            $transformer = new $this->transformer(explode(',', $request->get('includes')));
        } else {
            $transformer = new $this->transformer;
        }

        return $this->response->paginator($schemas, $transformer);
    }

    public function show($id, Request $request)
    {
        $schema = $this->repository->findById($id);

        if ($request->has('includes')) {
            $transformer = new $this->transformer(explode(',', $request->get('includes')));
        } else {
            $transformer = new $this->transformer;
        }

        return $this->response->item($schema, $transformer);
    }

    public function list(Request $request)
    {
        $query = $this->entity;

        $query = $this->applyConstraintsFromRequest($query, $request);
        $query = $this->applySearchFromRequest($query, ['type'], $request);
        $query = $this->applyOrderByFromRequest($query, $request);

        $schemas = $query->get();

        if ($request->has('includes')) {
            $transformer = new $this->transformer(explode(',', $request->get('includes')));
        } else {
            $transformer = new $this->transformer;
        }

        return $this->response->paginator($schemas, $transformer);
    }
}
