<?php

namespace App\Repository;

use App\Models\Task;
use App\Repository\TaskInterface;

class TaskRepository implements TaskInterface {
    public function __construct(protected Task $model)
    {}

    public function findAll(){
        return $this->model->all();
    }

    public function findOne($id){
        return $this->model->find($id);
    }
    public function new($data){
        if(!$this->model->create($data)){
            return redirect()->back();
        }
        $this->model->save();
    }

    public function edit() {

    }

    public function update(){

    }

    public function delete(){

    }
}
