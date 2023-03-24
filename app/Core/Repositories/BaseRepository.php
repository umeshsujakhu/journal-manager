<?php

namespace App\Core\Repositories;


use App\Core\Entities\BaseModel;
use App\Core\Interfaces\BasicCrudInterface;
use Illuminate\Support\Arr;

abstract class BaseRepository implements BasicCrudInterface
{
    /**
     * @var BaseModel|null
     */
    protected $model = null;

    /**
     * BaseRepository constructor.
     *
     * @param BaseModel|null $model
     */
    public function __construct(BaseModel $model = null)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     *
     * @return int
     */
    protected function getListLimit(array $params = [])
    {
        $perPage = $this->model->getPerPage();
        $limit = Arr::get($params, 'limit', $perPage);
        if (is_numeric($limit) && $limit > 0) {
            $perPage = intval($limit);
        }
        return $perPage;
    }

    /**
     * @param $model
     * @param array $params
     * @param bool $paginate
     *
     * @return mixed
     */
    protected function getListOfModel($model, array $params = [], $paginate = true)
    {
        if ($paginate) {
            return $model->paginate($this->getListLimit($params));
        }
        return $model->get();
    }

    /**
     * @param $id
     * @param array $attributes
     *
     * @return mixed
     */
    public function getById($id, array $attributes = [])
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $params
     * @param bool $paginate
     * @param array $attributes
     *
     * @return mixed
     */
    public function getList(array $params = [], $paginate = true, array $attributes = [])
    {
        return $this->getListOfModel($this->model, $params, $paginate, $attributes);
    }

    /**
     * @param $id
     * @param array $options
     *
     * @return mixed
     */
    public function delete($id, array $options = [])
    {
        $model = $this->model->findOrFail($id);
        return $model->delete();
    }

    /**
     * @param array $attributes
     * @param null $id
     *
     * @return BaseModel
     */
    protected function save(array $attributes, $id = null)
    {
        if ($id) {
            $model = $this->model->findOrFail($id);
        } else {
            $model = $this->model->newInstance();
        }
        $model->fill($attributes);
        $model->save();
        return $model;
    }

    /**
     * @param array $inputs
     *
     * @return BaseModel|mixed
     */
    public function create(array $inputs)
    {
        return $this->save($inputs);
    }

    /**
     * @param $id
     * @param array $attributes
     *
     * @return BaseModel|mixed
     */
    public function update($id, array $attributes)
    {
        return $this->save($attributes, $id);
    }
}
