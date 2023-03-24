<?php

namespace App\Core\Interfaces;

/**
 * Interface BasicCrudInterface
 */
interface BasicCrudInterface
{
    /**
     * @param $id
     * @param array $attributes
     *
     * @return mixed
     */
    public function getById($id,array $attributes=[]);

    /**
     * @param array $params
     * @param bool $paginate
     * @param array $attributes
     * @return mixed
     */
    public function getList(array $params = [], $paginate = true, array $attributes = []);

    /**
     * @param $id
     * @param array $attributes
     *
     * @return mixed
     */
    public function delete($id,array $attributes = []);

    /**
     * @param array $inputs
     *
     * @return mixed
     */
    public function create(array $inputs);

    /**
     * @param $id
     * @param array $attributes
     *
     * @return mixed
     */
    public function update($id, array $attributes);



}
