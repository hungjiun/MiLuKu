<?php


namespace App\Modules\Product\Repositories;

use App\Modules\Abstraction\Repositories\Repository;
use App\Modules\Product\Models\Category;
use Illuminate\Support\Facades\Log;

class CategoryRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Category::class;
    }

    /**
     * 建立商品分類
     *
     * @param array $condition
     * @return Model
     */
    public function createCategory(array $condition)
    {
        return $this->model->create($condition);
    }

    /**
     * 修改商品分類
     *
     * @param integer $id
     * @param array $condition
     * @return Model
     */
    public function updateCategory(int $id, array $condition)
    {
        return $this->model->where('id', $id)->update($condition);
    }

    public function findCategory(int $id)
    {
        return $this->model->where('id', $id)->first();
    }


    public function findCategories(array $categoryIds)
    {
        return $this->model->findMany($categoryIds);
    }
}
