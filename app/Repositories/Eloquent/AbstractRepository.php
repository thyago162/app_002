<?php

namespace App\Repositories\Eloquent;

abstract class AbstractRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    public function resolveModel()
    {
        return app($this->model);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function store($request)
    {
        $this->model->fill($request);
        $this->model->save();

        return $this->model;
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($id, $request)
    {
        $data = $this->model->findOrFail($id);
        $data->fill($request);
        $data->save();

        return $data;
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }
}
