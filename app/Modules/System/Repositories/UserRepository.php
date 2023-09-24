<?php


namespace App\Modules\System\Repositories;

use App\Modules\Abstraction\Repositories\Repository;
use App\Modules\System\Resources\UserResource;
use App\Models\User;

use Illuminate\Support\Facades\Log;

class UserRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }

    /**
     * 建立使用者
     *
     * @param array $condition
     * @return Model
     */
    public function createUser(array $condition)
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
    public function updateUser(int $id, array $condition)
    {
        return $this->model->where('id', $id)->update($condition);
    }

    public function findUser(int $id)
    {
        return $this->model->where('id', $id)->first();
    }


    public function findUsers(array $userIds)
    {
        return $this->model->findMany($userIds);
    }
}
