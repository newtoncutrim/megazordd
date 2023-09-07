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

    public function findOne($id){
        return  $this->repository->findOne($id);
    }

    public function new($data){
        return $this->repository->new($data);
    }

    public function edit() {

    }

    public function update($id, $request){
        return $this->repository->update($id, $request);
    }

    public function destroy($id){
        return $this->repository->delete($id);
    }
}
