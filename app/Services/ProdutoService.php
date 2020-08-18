<?php

namespace App\Services;

use App\Notifications\ProdutoAtualizado;
use App\Notifications\ProdutoCadastrado;
use App\Repositories\Eloquent\ProdutoRepository;
use App\Repositories\Eloquent\LojaRepository;

class ProdutoService
{
    protected $repository;
    protected $lojaRepository;

    public function __construct(ProdutoRepository $repository, LojaRepository $lojaRepository)
    {
        $this->repository = $repository;
        $this->lojaRepository = $lojaRepository;
    }

    public function allData()
    {
        return $this->repository->all();
    }

    public function storeData($request)
    {
        $produto = $this->repository->store($request);

        if ($produto) {
            $loja = $this->lojaRepository->show($produto->loja_id);
            $loja->notify(new ProdutoCadastrado($produto->nome, $loja->nome_loja));

            return $produto;
        }

        return $produto;
    }

    public function showData($id)
    {
        return $this->repository->show($id);
    }

    public function updateData($id, $request)
    {
        $produto = $this->repository->update($id, $request);

        if ($produto) {
            $loja = $this->lojaRepository->show($produto->loja_id);
            $loja->notify(new ProdutoAtualizado($produto->nome, $loja->nome_loja));

            return $produto;
        }

        return $produto;
    }

    public function destroyData($id)
    {
        return $this->repository->destroy($id);
    }
}
