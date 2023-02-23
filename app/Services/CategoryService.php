<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

        public function __construct(CategoryRepository $categoryRepository)
        {
            $this->categoryRepository = $categoryRepository;
        }

        public function getAllByPagination($search = [], $limit = null, $columns = ['*'])
        {
            return $this->categoryRepository->scopeQuery(function ($query) use ($search) {
                return $this->getScopeQuery($query, $search);
            })->orderBy('id', 'desc')->paginate($limit, $columns);
        }

        public function getAll($search = [])
        {
            return $this->categoryRepository->with(['parent', 'children'])->findWhere($search);
        }

        public function getById($id)
        {
            return $this->categoryRepository->with(['parent', 'children'])->find($id);
        }

        public function create($data= [])
        {
            return $this->categoryRepository->create($data);
        }

        public function update($data = [], $id)
        {
            return $this->categoryRepository->update($data, $id);
        }

        public function delete($id)
        {
            return $this->categoryRepository->delete($id);
        }

        protected function getScopeQuery($query, $search = [])
        {
            if (isset($search['name'])) {
                $query->where('name', 'like', '%' . $search['name'] . '%');
            }

            return $query;
        }
}