<?php

namespace App\Repositories\Eloquent;

use App\Loja;
use App\Repositories\Contracts\LojaInterface;

class LojaRepository extends AbstractRepository implements LojaInterface
{
    protected $model = Loja::class;

    public function produtosPorLoja($id)
    {
        return Loja::find($id)->produtos->where('ativo', 1);
    }
}
