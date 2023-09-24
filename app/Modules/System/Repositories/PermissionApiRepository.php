<?php


namespace App\Modules\System\Repositories;

use App\Modules\Abstraction\Repositories\Repository;
use App\Modules\System\Models\PermissionApi;

use Illuminate\Support\Facades\Log;

class PermissionApiRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return PermissionApi::class;
    }

    /**
     * 建立權限API
     *
     * @param array $condition
     * @return Model
     */
    public function createPermissionApi(array $condition)
    {
        return $this->model->create($condition);
    }

    /**
     * 修改權限API
     *
     * @param integer $id
     * @param array $condition
     * @return Model
     */
    public function updatePermissionApi(int $id, array $condition)
    {
        return $this->model->where('id', $id)->update($condition);
    }

    /**
     * 搜尋權限API
     *
     * @param array $whereColumns
     * @param string $role
     * @param string $sortBy
     * @param string $order
     * @param integer $page
     * @param integer $numberPerPage
     * @return array
     */
    public function searchPermissionApi(
        array $whereColumns = [],
        string $sortBy,
        string $order,
        int $page,
        int $numberPerPage
    ) {
        $query = $this->model->select(
            'id',
            'permission_name',
            'api',
        )->where($whereColumns);

        $total = $query->count();
        $offset = ($page - 1) * $numberPerPage;
        $data = $query
            ->orderBy($sortBy, $order)
            ->limit($numberPerPage)
            ->offset($offset)
            ->get();
        return [
            'current_page' => $page,
            'number_per_page' => $numberPerPage,
            'total' => $total,
            'data' => $data,
        ];
    }

    public function getAllPermissionApi()
    {
        return $this->model->get();
    }

    public function findPermissionApi(int $id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function findPermissionNameByApi(string $api)
    {
        return $this->model->where('api', $api)->first();
    }
}
