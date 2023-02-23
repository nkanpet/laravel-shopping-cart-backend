<?php

namespace App\Http\Controllers\API\V1;

use App\Enums\CategoryEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\CategoryCollection;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $categories = $this->categoryService->getAll(['parent_id' => null, 'status' => CategoryEnum::STATUS_ACTIVE]);

        return response()->json([
            'success' => true,
            'data' => new CategoryCollection($categories),
            'message' => 'Success'
        ], 200);
    }

    public function show($id)
    {
        $category = $this->categoryService->getById($id);

        return response()->json([
            'success' => true,
            'data' => new CategoryResource($category),
            'message' => 'success'
        ], 200);
    }
}
