<?php

/*
 * This file is part of the knn.
 *
 * (c) WishMobile
 */

namespace App\Modules\Abstraction;

//use Illuminate\Support\Arr;

abstract class AbstractService
{
    /**
     * @var Model
     */
    public $model;

    /**
     *
     */
    public $table;

    /**
     *
     */
    public $repository;

    /**
     *
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     *
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * create
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data = [])
    {
        return $this->repository->create($data);
    }

    /**
     * getById
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getById(int $id = 0)
    {
        return $this->repository->getById($id);
    }

    /**
     * getById
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getByIds(array $ids = [])
    {
        return $this->repository->getByIds($ids);
    }

    /**
     * gets
     *
     * @param array $map
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function gets(array $map = [])
    {
        return $this->repository->gets($map);
    }

    /**
     * update
     *
     * @param int $id
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id = 0, array $data = [])
    {
        return $this->repository->update($id, $data);
    }

    /**
     * remove
     *
     * @param int $id
     * @return bool
     */
    public function remove(int $id = 0): bool
    {
        return $this->repository->remove($id);
    }

    /**
     * removes
     *
     * @param array $ids
     * @return bool
     */
    public function removes(array $ids = [])
    {
        return $this->repository->removes($ids);
    }

    /**
     *
     */
    public function getPageList($query, int $start = 0, int $numberPerPage = 10)
    {
        $countQuery = clone $query;
        $idsQuery = clone $query;
        $count = $countQuery->count();
        $ids = $idsQuery->skip($start)->take($numberPerPage)->pluck('id')->toArray();
        $data = $query->whereIn('id', $ids)->get();
        return [
            'count' => $count,
            'data' => $data
        ];
    }
}
