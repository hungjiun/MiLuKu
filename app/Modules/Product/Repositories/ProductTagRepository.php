<?php


namespace App\Modules\Product\Repositories;

use App\Modules\Abstraction\Repositories\Repository;
use App\Modules\Product\Models\ProductTag;
use Illuminate\Support\Facades\Log;

class ProductTagRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return ProductTag::class;
    }

    /**
     * 建立商品標籤
     *
     * @param array $condition
     * @return Model
     */
    public function createProductTag(array $condition)
    {
        return $this->model->create($condition);
    }

    /**
     * 修改商品標籤
     *
     * @param integer $id
     * @param array $condition
     * @return Model
     */
    public function updateProductTag(int $id, array $condition)
    {
        return $this->model->where('id', $id)->update($condition);
    }

    public function findProductTag(int $id)
    {
        return $this->model->where('id', $id)->first();
    }


    public function findProductTags(array $productTagIds)
    {
        return $this->model->findMany($productTagIds);
    }
}
