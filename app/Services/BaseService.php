<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class BaseService implements IService
{
    protected Model $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function store(array $data)
    {
        $this->model->fill($data)->save();
        return $this->model;
    }

    public function getBy(array $criteria)
    {
        return $this->model->where($criteria)->get();
    }

    public function getOneBy(array $criteria)
    {
        return $this->model->where($criteria)->first();
    }

    public function getById(int $id)
    {
        return $this->model->find($id);
    }

}
