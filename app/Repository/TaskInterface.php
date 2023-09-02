<?php

namespace App\Repository;

interface TaskInterface
{
    public function findAll();
    public function findOne();
    public function new();
    public function edit();
    public function update();
    public function delete();
}
