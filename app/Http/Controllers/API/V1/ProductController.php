<?php

namespace App\Http\Controllers\API\V1;

use App\Enums\ProductEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\ProductCollection;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $products = $this->productService->getAllByPagination($request->all());
        $collection = new ProductCollection($products);

        return response()->json([
            'success' => true,
            'data' => $collection->response()->getData(true),
            'message' => 'success'
        ], 200);
    }

    public function show($id)
    {
        $product = $this->productService->getOneOrFail([
            'id' => $id,
            'status' => ProductEnum::STATUS_ACTIVE
        ]);

        return response()->json([
            'success' => true,
            'data' => new ProductResource($product),
            'message' => 'success'
        ], 200);
    }
}
