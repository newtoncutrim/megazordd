<?php

namespace App\Repository\Contract;

interface InterfaceRepository
{
    public function findAll();
    public function findOne($id);
    public function new($data);
    public function edit();
    public function update($id, $request);
    public function delete($id);

}
