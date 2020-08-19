<?php

namespace App\Services;

use App\Repositories\Contracts\LojaInterface;
use Exception;
use Illuminate\Database\QueryException;

class LojaService
{
    protected $repository;

    public function __construct(LojaInterface $repository)
    {
        $this->repository = $repository;
    }

    public function allData()
    {
        try {
            $loja = $this->repository->all();

            return ['cod' => 200, 'data' => $loja];
        } catch (Exception $e) {
            if ($e instanceof QueryException) {
                return ['cod' => 500, 'mensagem' => 'Falha na comunicação com o banco de dados'];
            }

            return ['cod' => 500, 'mensagem' => 'Falha na comunicação com o servidor'];
        }
    }

    public function storeData($request)
    {
        try {
            $loja = $this->repository->store($request);

            return ['cod' => 200, 'data' => $loja];
        } catch (Exception $e) {
            if ($e instanceof QueryException) {
                return ['cod' => 500, 'mensagem' => 'Falha na comunicação com o banco de dados'];
            }

            return ['cod' => 500, 'mensagem' => 'Falha na comunicação com o servidor'];
        }
    }

    public function showData($id)
    {
        try {
            $loja = $this->repository->show($id);

            return ['cod' => 200, 'data' => $loja];
        } catch (Exception $e) {
            if ($e instanceof QueryException) {
                return ['cod' => 500, 'mensagem' => 'Falha na comunicação com o banco de dados'];
            }

            return ['cod' => 500, 'mensagem' => 'Falha na comunicação com o servidor'];
        }
    }

    public function updateData($id, $request)
    {
        try {
            $loja = $this->repository->update($id, $request);

            return ['cod' => 200, 'data' => $loja];
        } catch (Exception $e) {
            if ($e instanceof QueryException) {
                return ['cod' => 500, 'mensagem' => 'Falha na comunicação com o banco de dados'];
            }

            return ['cod' => 500, 'mensagem' => 'Falha na comunicação com o servidor'];
        }
    }

    public function destroyData($id)
    {

        try {
            $loja = $this->repository->destroy($id);

            return ['cod' => 200, 'data' => $loja];
        } catch (Exception $e) {
            if ($e instanceof QueryException) {
                return ['cod' => 500, 'mensagem' => 'Falha na comunicação com o banco de dados'];
            }

            return ['cod' => 500, 'mensagem' => 'Falha na comunicação com o servidor'];
        }
    }

    public function produtosData($id)
    {
        try {
            $loja = $this->repository->produtosPorLoja($id);

            return ['cod' => 200, 'data' => $loja];
        } catch (Exception $e) {
            if ($e instanceof QueryException) {
                return ['cod' => 500, 'mensagem' => 'Falha na comunicação com o banco de dados'];
            }

            return ['cod' => 500, 'mensagem' => 'Falha na comunicação com o servidor'];
        }
    }
}
