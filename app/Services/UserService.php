<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllByPagination($search = [], $limit = null, $columns = ['*'])
        {
            return $this->userRepository->scopeQuery(function ($query) use ($search) {
                return $this->getScopeQuery($query, $search);
            })->orderBy('id', 'desc')->paginate($limit, $columns);
        }

        public function getAll($search = [])
        {
            return $this->userRepository->findWhere($search);
        }

        public function getById($id)
        {
            return $this->userRepository->find($id);
        }

        public function create($data= [])
        {
            return $this->userRepository->create($data);
        }

        public function update($data = [], $id)
        {
            return $this->userRepository->update($data, $id);
        }

        public function delete($id)
        {
            return $this->userRepository->delete($id);
        }

        protected function getScopeQuery($query, $search = [])
        {
            if (isset($search['name'])) {
                $query->where('name', 'like', '%' . $search['name'] . '%');
            }

            if (isset($search['email'])) {
                $query->where('email', 'like', '%' . $search['email'] . '%');
            }

            return $query;
        }
}

