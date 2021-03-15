<?php

namespace VCComponent\Laravel\Product\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use VCComponent\Laravel\Product\Repositories\ProductImagesDimensionHeightRepository;
use VCComponent\Laravel\Product\Transformers\ProductImagesDimensionHeightTransformer;
use VCComponent\Laravel\Product\Validators\ProductImagesDimensionHeightValidator;

use VCComponent\Laravel\Vicoders\Core\Controllers\ApiController;

class ProductImagesDimensionHeightController extends ApiController
{
    protected $repository;
    protected $validator;

    public function __construct(ProductImagesDimensionHeightRepository $repository, ProductImagesDimensionHeightValidator $validator)
    {
        $this->repository  = $repository;
        $this->entity      = $repository->getEntity();
        $this->validator   = $validator;
        $this->transformer = ProductImagesDimensionHeightTransformer::class;

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
        $query = $this->applySearchFromRequest($query, ['value'], $request);
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

    public function store(Request $request)
    {
        $this->validator->isValid($request, 'RULE_ADMIN_CREATE');

        $data = $request->all();
        $schema = $this->repository->create($data);

        return $this->response->item($schema, new $this->transformer);
    }

    public function update(Request $request, $id)
    {
        $this->validator->isValid($request, 'RULE_ADMIN_UPDATE');

        $this->repository->findById($id);

        $data = $request->all();

        $schema = $this->repository->update($data, $id);

        return $this->response->item($schema, new $this->transformer);
    }

    public function destroy($id)
    {
        $schema = $this->repository->findById($id);

        $schema->delete();

        return $this->success();
    }
}
