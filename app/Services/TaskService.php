<?php

namespace App\Services;

use Carbon\Carbon;
use App\Repository\TaskInterface;

class TaskService {
    public function __construct(protected TaskInterface $repository)
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

    public function update($id, $request){
        if($request && $id){
            return $this->repository->update($id, $request);
        }
        return 'nao atualizado';
    }

    public function destroy($id){
        if($id){
            return $this->repository->delete($id);
        }

        return redirect()->back();
    }

    public function dataFormat($data){

        $datas = Carbon::parse($data)->format('d/m/Y');

        return $datas;
    }
}
