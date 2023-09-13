<?php

namespace App\Services;

use Carbon\Carbon;

use App\Repository\TaskRepository;

class TaskService {
    public function __construct(protected TaskRepository $repository)
    {}

    public function findAll(){
        return $this->repository->findAll();
    }

    public function findOne($id){
        return  $this->repository->findOne($id);
    }

    public function new($data){
        if($data){
        return $this->repository->new($data);
        }
    }

    public function edit() {

    }

    public function updateTask($request, string $id){
        $task = $this->findOne($id);
        if (!$task) {
            throw new \Exception('Registro não encontrado');
        }
        return $this->repository->update($id, $request);
    }

    public function destroy($id){
        if($id){
            return $this->repository->delete($id);
        }

        return redirect()->back();
    }

    public function dataFormat($data){

        return Carbon::parse($data)->format('d/m/Y');
    }
}
