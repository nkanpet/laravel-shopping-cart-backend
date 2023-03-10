<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProductRepository;
use App\Models\Product;
use App\Validators\ProductValidator;

/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function findOneOrFail($where = [])
    {
        return $this->model()::where($where)->firstOrFail();
    }
    
}
