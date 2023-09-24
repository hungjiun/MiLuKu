<?php

namespace App\Modules\Abstraction\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

abstract class Repository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     *
     */
    protected $table;

    /**
     *
     */
    protected $columns = [];

    /**
     *
     */
    protected $modifiableColumns = [];


    /**
     * @return string
     */
    abstract public function model(): string;

    /**
     * Instantiate a new repository instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = app($this->model());
        $this->table = $this->model->getTable();

        $this->columns = $this->model->getConnection()
            ->getSchemaBuilder()
            ->getColumnListing($this->model->getTable());
        $this->modifiableColumns = Arr::except($this->columns, ['create_time', 'update_time']);
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getTable()
    {
        return $this->table;
    }

    public function getTableColumns ()
    {
        return $this->columns;
    }

    public function getModifiableColumns ()
    {
        return $this->modifiableColumns;
    }

    public function query()
    {
        return $this->model->query();
    }

    /**
     * check whether the model instance exists
     *
     * @param  array  $map
     * @return bool
     */
    public function exist (array $map = [] ): bool
    {
        return $this->model->where( $map )->exists();
    }

    /**
     * @param  int  $id
     * @return Model
     */
    public function getById(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * @param  array  $ids
     * @return Model[]
     */
    public function getByIds(array $ids = [])
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    /**
     * gets
     *
     * @param array $map
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function gets(array $map = [])
    {
        return $this->model->where($map)->get();
    }

    /**
     * add a new instance
     *
     * @param  mixed  $data
     * @return Model|null
     */
    public function create ( array $condition = [] )
    {
        return $this->model->create($condition);
    }

    /**
     * edit a instance
     *
     * @param  int  $id
     * @param  mixed  $data
     * @return Model|null
     */
    public function update ( int $id = 0, array $condition = [] )
    {
        return $this->model->where('id', $id)->update($condition);
    }

    /**
     * delete by id
     *
     * @param  int  $id
     * @return bool
     */
    public function remove( int $id = 0 ): bool
    {
        return $this->model->where('id', $id)->delete();
    }

    /**
     * delete by ids
     *
     * @param  array  $ids
     * @return bool
     */
    public function removes( array $ids = [] ): bool
    {
        if( !is_array($ids) ) {
            return false;
        }
        return $this->model->whereIn('id', $ids)->delete();
    }

    /**
     *
     */
    public function truncate()
    {
        return $this->model->truncate();
    }
}
