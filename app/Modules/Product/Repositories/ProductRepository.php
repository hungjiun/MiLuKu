<?php


namespace App\Modules\Product\Repositories;

use App\Modules\Abstraction\Repositories\Repository;
use App\Modules\Product\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Product::class;
    }

    /**
     * 建立商品
     *
     * @param array $condition
     * @return Model
     */
    public function createProduct(array $condition)
    {
        return $this->model->create($condition);
    }

    /**
     * 修改商品
     *
     * @param integer $id
     * @param array $condition
     * @return Model
     */
    public function updateProduct(int $id, array $condition)
    {
        return $this->model->where('id', $id)->update($condition);
    }

    public function findProduct(int $id)
    {
        return $this->model->where('id', $id)->first();
    }


    public function findProducts(array $productIds)
    {
        return $this->model->findMany($productIds);
    }
}
