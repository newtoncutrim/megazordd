<?php

namespace App\Services;

use App\Repository\TaskInterface;

class TaskService {
    public function __construct(protected TaskInterface $repository)
    {

    }
    public function findAll(){
        return $this->repository->findAll();
    }

    public function findOne(){

    }
    public function new(){
        return $this->repository->new();
    }

    public function edit() {

    }

    public function update(){

    }

    public function destroy(){

    }
}
