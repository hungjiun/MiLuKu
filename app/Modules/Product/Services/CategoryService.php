<?php

namespace App\Modules\Product\Services;

use App\Exceptions\ECException;
use App\Modules\Product\Repositories\CategoryRepository;
use App\Modules\Product\Constants\CategoryStatus;
use App\Modules\Product\Resources\CategoryResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryService
{

    protected $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function create(array $request)
    {
        DB::beginTransaction();
        $request['status'] = CategoryStatus::DISABLE;
        $insertResult = $this->categoryRepository->createCategory($request);
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

        $updateCategory = $this->categoryRepository->findCategory($request['id']);

        if (isset($request['title'])) {
            $updateCategory->title  = $request['title'];
        }
        if (isset($request['images'])) {
            $updateCategory->images  = $request['images'];
        }
        if (isset($request['display_order'])) {
            $updateCategory->display_order = $request['display_order'];
        }
        if (isset($request['status'])) {
            $updateCategory->status = $request['status'];
        }
        $updateResult = $updateCategory->save();
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
        $updateResult = $this->categoryRepository->updateCategory($request['id'], $update);
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

        $count = $this->categoryRepository->query()->count();
        $query = $this->categoryRepository->query();
        if (!empty($sortColumn)) {
            $query->orderBy($sortColumn, $orderDir);
        }
        $result = $query->limit($length)
                        ->offset($start)
                        ->select(
                            'id',
                            'parent_id',
                            'title',
                            'images',
                            'display_order',
                            'status',
                            'created_at',
                            'updated_at'
                        )->get();

        return [
            "draw" => $draw,
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" => CategoryResource::collection($result)
        ];
    }

    public function find(int $id)
    {
        return $this->categoryRepository->findCategory($id);
    }

    public function getCategoriesInfo(array $ids)
    {
        $categories = $this->categoryRepository->findCategories($ids);
        $categoryInfos = collect($categories)->map(function($category){
            return [
                'id' =>  $category->id,
                'parent_id' => $category->parent_id,
                'title' => $category->title,
                'images' => $category->images,
                'display_order' => $category->display_order,
                'status' => $category->status,
            ];
        });

        return $categoryInfos;
    }
}
