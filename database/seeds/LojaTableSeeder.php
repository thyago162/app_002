<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LojaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('lojas')->insert([
           'nome_loja' => 'Loja padrão',
           'email' => 'contato@lojapadrao.com.br'
       ]);
    }
}
