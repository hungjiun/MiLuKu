<?php

namespace App\Modules\Product\Services;

use App\Exceptions\ECException;
use App\Modules\Product\Repositories\ProductRepository;
use App\Modules\Product\Constants\ProductStatus;
use App\Modules\Product\Resources\ProductResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductService
{

    protected $productRepository;

    public function __construct(
        ProductRepository $productRepository
    )
    {
        $this->productRepository = $productRepository;
    }

    public function create(array $request)
    {
        DB::beginTransaction();
        $request['status'] = ProductStatus::DISABLE;
        $insertResult = $this->productRepository->createProduct($request);
        if (!$insertResult) {
            DB::rollBack();
            return $insertResult;
        }

        DB::commit();
        return $insertResult;
    }

    public function update(array $request)
    {
        DB::beginTransaction();

        $updateProduct = $this->productRepository->findProduct($request['id']);

        if (isset($request['product_code'])) {
            $updateProduct->product_code  = $request['product_code'];
        }
        if (isset($request['display_order'])) {
            $updateProduct->display_order = $request['display_order'];
        }
        if (isset($request['open'])) {
            $updateProduct->open = $request['open'];
        }
        if (isset($request['status'])) {
            $updateProduct->status = $request['status'];
        }
        $updateResult = $updateProduct->save();
        if (!$updateResult) {
            DB::rollBack();
            return $updateResult;
        }

        DB::commit();
        return $updateResult;
    }

    public function updateStatus(array $request)
    {
        DB::beginTransaction();
        $update = [
            'status' => $request['status'],
        ];
        $updateResult = $this->productRepository->updateProduct($request['id'], $update);
        if (!$updateResult) {
            DB::rollBack();
            return $updateResult;
        }

        DB::commit();
        return $updateResult;
    }

    public function search($request)
    {
        $draw = data_get($request, 'draw', 0);
        $start = data_get($request, 'start', 0);
        $length = data_get($request, 'length', 0);
        $orderIndex = data_get($request, 'order.0.column', 0);
        $orderDir = data_get($request, 'order.0.dir', 'asc');
        $columns = data_get($request, 'columns', []);
        $sortColumn = data_get($request, "columns.{$orderIndex}.name", '');

        $count = $this->productRepository->query()->count();
        $query = $this->productRepository->query();
        if (!empty($sortColumn)) {
            $query->orderBy($sortColumn, $orderDir);
        }
        $result = $query->limit($length)
                        ->offset($start)
                        ->select(
                            'id',
                            'product_code',
                            'display_order',
                            'open',
                            'status',
                            'created_at',
                            'updated_at'
                        )->get();

        return [
            "draw" => $draw,
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" => ProductResource::collection($result)
        ];
    }

    public function find(int $id)
    {
        return $this->productRepository->findProduct($id);
    }

    public function getProductsInfo(array $ids)
    {
        $products = $this->productRepository->findProducts($ids);
        $productInfos = collect($products)->map(function($product){
            return [
                'id' =>  $product->id,
                'product_code' => $product->product_code,
                'display_order' => $product->display_order,
                'open' => $product->open,
                'status' => $product->status,
            ];
        });

        return $productInfos;
    }
}
