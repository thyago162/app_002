<?php
namespace App\Repositories\Contracts;

interface AppInterface
{
    public function all();
    public function store($data);
    public function show($id);
    public function update($id, $data);
    public function destroy($id);
}
