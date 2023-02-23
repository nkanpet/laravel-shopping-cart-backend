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

    public function getOneOrFail($where = [])
    {
        return $this->productRepository->findOneOrFail($where);
    }

    public function create($data = [])
    {
        $image = $data['image'];
        $data['image'] = $image->store('products', 'public');
        $product = $this->productRepository->create($data);

        if ($product) {
            if (isset($data['product_categories'])) {
                foreach ($data['product_categories'] as $category_id) {
                    $product->categories()->create([
                        'category_id' => $category_id
                    ]);
                }
            }
        }

        return $product;
    }

    public function update($data = [], $id)
    {
        if (isset($data['image'])) {
            $image = $data['image'];
            $data['image'] = $image->store('products', 'public');
        }

        $product = $this->productRepository->update($data, $id);

        if (isset($data['product_categories'])) {
            $category_ids = $data['product_categories'];

            $product->categories()->whereNotIn('category_id', $category_ids)->delete();

            foreach ($data['product_categories'] as $category_id) {
                $product->categories()->updateOrCreate([
                    'category_id' => $category_id
                ]);
            }
        } else {
            $product->categories()->delete();
        }

        return $product;
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

        if (isset($search['category_id'])) {
            $query->whereHas('categories', function ($sub_query) use ($search) {
                $sub_query->where('category_id', $search['category_id']);
            });
        }

        return $query;
    }
}
