<?php


namespace App\Modules\System\Repositories;

use App\Modules\Abstraction\Repositories\Repository;
use App\Modules\System\Models\LoginLog;

use Illuminate\Support\Facades\Log;

class LoginLogRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return LoginLog::class;
    }

    /**
     * 建立使用者登入紀錄
     *
     * @param array $condition
     * @return Model
     */
    public function createLoginLog(array $condition)
    {
        return $this->model->create($condition);
    }

    /**
     * 搜尋使用者登入紀錄
     *
     * @param array $whereColumns
     * @param string $sortBy
     * @param string $order
     * @param integer $page
     * @param integer $numberPerPage
     * @return array
     */
    public function searchLoginLog(
        array $whereColumns = [],
        string $sortBy,
        string $order,
        int $page,
        int $numberPerPage
    ) {
        $query = $this->model->select(
            'id',
            'account',
            'name',
            'status',
            'updated_by',
            'created_at',
            'updated_at'
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

    public function findLoginLog(int $id)
    {
        return $this->model->where('id', $id)->first();
    }


    public function findLoginLogs(array $ids)
    {
        return $this->model->findMany($ids);
    }
}
