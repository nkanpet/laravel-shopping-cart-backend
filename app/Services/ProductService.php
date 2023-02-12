<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllByPagination($search = [], $limit = null, $columns = ['*'])
    {
        return $this->productRepository->scopeQuery(function ($query) use ($search) {
            return $this->getScopeQuery($query, $search);
        })->orderBy('id', 'desc')->paginate($limit, $columns);
    }

    public function getById($id)
    {
        return $this->productRepository->find($id);
    }

    public function create($data = [])
    {
        $image = $data['image'];
        $data['image'] = $image->store('products', 'public');

        return $this->productRepository->create($data);
    }

    public function update($data = [], $id)
    {
        if (isset($data['image'])) {
            $image = $data['image'];
            $data['image'] = $image->store('products', 'public');
        }

        return $this->productRepository->update($data, $id);
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }

    protected function getScopeQuery($query, $search = [])
    {
        if (isset($search['name'])) {
            $query->where('name', 'like', '%' . $search['name'] . '%');
        }

        return $query;
    }
}
