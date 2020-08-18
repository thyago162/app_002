<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $primaryKey = 'id_produto';
    protected $fillable = [
        'nome', 'valor', 'loja_id', 'ativo'
    ];

    public function loja()
    {
        return $this->hasOne('App\Loja', 'produto_id');
    }

    public function getValorAttribute()
    {
        $valor = $this->attributes['valor'];

        return number_format($valor, 2, ',', ',');
    }
}
