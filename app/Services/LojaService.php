<?php

namespace App\Services;

use App\Repositories\Contracts\LojaInterface;
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make(
            $request,
            $this->rules(),
            $this->messages()
        );

        if ($validator->fails()) {
            return [
                'mensagem' => $validator->errors()->toArray(),
                'cod' => 403
            ];
        }

        try {
            $loja = $this->repository->store($request);

            return ['cod' => 200, 'data' => $loja];
        } catch (Exception $e) {
            if ($e instanceof QueryException) {
                return ['cod' => 500, 'mensagem' => $e->getMessage()];
            }

            return ['cod' => 500, 'mensagem' => $e->getMessage()];
        }
    }

    public function showData($id)
    {
        try {
            $loja = $this->repository->show($id);

            return ['cod' => 200, 'data' => $loja];
        } catch (Exception $e) {
            if ($e instanceof QueryException) {
                return ['cod' => 500, 'mensagem' => $e->getMessage()];
            }

            return ['cod' => 500, 'mensagem' => $e->getMessage()];
        }
    }

    public function updateData($id, $request)
    {
        $validator = Validator::make(
            $request,
            $this->rules(),
            $this->messages()
        );

        if ($validator->fails()) {
            return [
                'mensagem' => $validator->errors()->toArray(),
                'cod' => 403
            ];
        }

        try {
            $loja = $this->repository->update($id, $request);

            return ['cod' => 200, 'data' => $loja];
        } catch (Exception $e) {
            if ($e instanceof QueryException) {
                return ['cod' => 500, 'mensagem' => $e->getMessage()];
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

    public function rules()
    {
        return [
            'nome_loja' => 'required|string|max:40|min:3',
            'email' => 'required|email'
        ];
    }

    public function messages()
    {
        return [
            'nome_loja.required' => 'O campo NOME é obrigatório',
            'nome_loja.string' => 'Formato inválido para o campo NOME',
            'nome_loja.min' => 'Tamanho mínimo para o campo NOME é de 3 caracteres',
            'nome_loja.max' => 'Tamanho máximo para o campo NOME é de 40 caracteres',
            'email.required' => 'O campo EMAIL é obrigatório',
            'email.email' => 'Formato inválido para o campo EMAIL'
        ];
    }
}
