<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Loja extends Model
{
    use Notifiable;

    protected $primaryKey = 'id_loja';
    protected $fillable = [
        'nome_loja', 'email'
    ];

    public function produtos()
    {
        return $this->hasMany(Produto::class, 'loja_id');
    }


}
