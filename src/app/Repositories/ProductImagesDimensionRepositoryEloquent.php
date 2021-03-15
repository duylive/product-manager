<?php

namespace VCComponent\Laravel\Product\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use VCComponent\Laravel\Product\Entities\ProductImagesDimension;

class ProductImagesDimensionRepositoryEloquent extends BaseRepository implements ProductImagesDimensionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */

    public function model()
    {
        return ProductImagesDimension::class;
    }

    public function getEntity()
    {
        return $this->model;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function findById($id)
    {
        $schema = $this->model->find($id);
        if (!$schema) {
            throw new \Exception('Không tìm thấy kích thước !', 1);
        }
        return $schema;
    }
}
