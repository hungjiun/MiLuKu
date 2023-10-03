<?php


namespace App\Modules\File\Repositories;

use App\Modules\Abstraction\Repositories\Repository;
use App\Modules\File\Models\File;
use Illuminate\Support\Facades\Log;

class FileRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return File::class;
    }

    /**
     * @param array $condition
     * @return Model
     */
    public function createFile(array $condition)
    {
        return $this->model->create($condition);
    }

    /**
     * 修改會員資料
     *
     * @param integer $id
     * @param array $condition
     * @return Model
     */
    public function updateFile(int $id, array $condition)
    {
        return $this->model->where('id', $id)->update($condition);
    }

    public function findFile(int $id)
    {
        return $this->model->where('id', $id)->first();
    }


    public function findFiles(array $ids = [])
    {
        return $this->model->findMany($ids);
    }
}
