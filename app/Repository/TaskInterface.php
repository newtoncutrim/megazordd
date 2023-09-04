<?php

namespace App\Repository;

interface TaskInterface
{
    public function findAll();
    public function findOne($id);
    public function new($data);
    public function edit();
    public function update();
    public function delete();
}
