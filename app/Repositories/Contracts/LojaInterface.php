<?php

namespace App\Repositories\Contracts;

interface LojaInterface extends AppInterface
{
    public function produtosPorLoja($id);
}
