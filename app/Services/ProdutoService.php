<?php

namespace App\Services;

use App\Notifications\ProdutoAtualizado;
use Illuminate\Support\Facades\Validator;
use App\Notifications\ProdutoCadastrado;
use App\Repositories\Eloquent\ProdutoRepository;
use App\Repositories\Eloquent\LojaRepository;
use Exception;
use Illuminate\Database\QueryException;

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
        try {
            $produto = $this->repository->all();

            return ['cod' => 200, 'data' => $produto];
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
            $produto = $this->repository->store($request);

            if ($produto) {
                $loja = $this->lojaRepository->show($produto->loja_id);
                $loja->notify(new ProdutoCadastrado($produto->nome, $loja->nome_loja));
            }
            return ['cod' => 200, 'data' => $produto];
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
            $produto = $this->repository->show($id);

            return ['cod' => 200, 'data' => $produto];
        } catch (Exception $e) {
            if ($e instanceof QueryException) {
                return ['cod' => 500, 'mensagem' => 'Falha na comunicação com o banco de dados'];
            }

            return ['cod' => 500, 'mensagem' => 'Falha na comunicação com o servidor'];
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
            $produto = $this->repository->update($id, $request);

            if ($produto) {
                $loja = $this->lojaRepository->show($produto->loja_id);
                $loja->notify(new ProdutoAtualizado($produto->nome, $loja->nome_loja));
            }

            return ['cod' => 200, 'data' => $produto];
        } catch (Exception $e) {
            if ($e instanceof QueryException) {
                return ['cod' => 500, 'mensagem' => $e->getMessage()];
            }

            return ['cod' => 500, 'mensagem' => $e->getMessage()];
        }
    }

    public function destroyData($id)
    {
        try {
            $produto = $this->repository->destroy($id);

            return ['cod' => 200, 'data' => $produto];
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
            'nome' => 'required|string|max:60|min:3',
            'valor' => 'required|max:6|min:2',
            'loja_id' => 'integer',
            'ativo' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo NOME é obrigatório',
            'nome.string' => 'Formato inválido para o campo NOME',
            'nome.min' => 'Tamanho mínimo para o campo NOME é de 3 caracteres',
            'nome.max' => 'Tamanho máximo para o campo NOME é de 60 caracteres',
            'valor.required' => 'O campo VALOR é obrigatório',
            'valor.integer' => 'Formato inválido para o campo VALOR',
            'valor.max' => 'Tamanho excedido, são permitido apenas 6 digitos',
            'valor.min' => 'Tamanho excedido, são permitidos no minimo 2 digitos',
            'loja_id.integer' => 'Formato inválido para o campo LOJA',
            'ativo.boolean' => 'Formato inválido para o campo ATIVO'
        ];
    }
}
