<?php

namespace VCComponent\Laravel\Product\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use VCComponent\Laravel\Product\Repositories\ProductImagesDimensionNameRepository;
use VCComponent\Laravel\Product\Transformers\ProductImagesDimensionNameTransformer;
use VCComponent\Laravel\Product\Validators\ProductImagesDimensionNameValidator;

use VCComponent\Laravel\Vicoders\Core\Controllers\ApiController;

class ProductImagesDimensionNameController extends ApiController
{
    protected $repository;
    protected $validator;

    public function __construct(ProductImagesDimensionNameRepository $repository, ProductImagesDimensionNameValidator $validator)
    {
        $this->repository  = $repository;
        $this->entity      = $repository->getEntity();
        $this->validator   = $validator;
        $this->transformer = ProductImagesDimensionNameTransformer::class;

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
        $query = $this->applySearchFromRequest($query, ['name'], $request);
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
        $query = $this->applySearchFromRequest($query, ['name'], $request);
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
