<?php

namespace App\Services;

use App\Repositories\Contracts\LojaInterface;

class LojaService
{
    protected $repository;

    public function __construct(LojaInterface $repository)
    {
        $this->repository = $repository;
    }

    public function allData()
    {
        return $this->repository->all();
    }

    public function storeData($request)
    {
        return $this->repository->store($request);
    }

    public function showData($id)
    {
        return $this->repository->show($id);
    }

    public function updateData($id, $request)
    {
        return $this->repository->update($id, $request);
    }

    public function destroyData($id)
    {
        return $this->repository->destroy($id);
    }

    public function produtosData($id)
    {
        return $this->repository->produtosPorLoja($id);
    }
}
