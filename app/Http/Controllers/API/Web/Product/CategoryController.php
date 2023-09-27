<?php

namespace App\Http\Controllers\API\Web\Product;

use App\Http\Controllers\Controller;
use App\Modules\Product\Services\CategoryService;
use App\Http\Responses\ECResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * \App\Modules\Product\Services\CategoryService
     */
    protected $categoryService;

    /*
     *
     */
    public function __construct (CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function getCategories(Request $request)
    {

        $result = $this->categoryService->search($request->all());
        return new ECResponse($result);
    }
}
