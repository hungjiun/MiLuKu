<?php

namespace App\Http\Controllers\API\Web\Product;

use App\Http\Controllers\Controller;
use App\Modules\Product\Services\ProductService;
use App\Http\Responses\ECResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * \App\Modules\Product\Services\ProductService
     */
    protected $productService;

    /*
     *
     */
    public function __construct (ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getProducts(Request $request)
    {

        $result = $this->productService->search($request->all());
        return new ECResponse($result);
    }
}
