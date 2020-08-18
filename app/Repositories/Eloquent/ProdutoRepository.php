<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\ProdutoInterface;
use App\Produto;

class ProdutoRepository extends AbstractRepository implements ProdutoInterface
{
    protected $model = Produto::class;
}
