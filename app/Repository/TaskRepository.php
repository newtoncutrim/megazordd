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

    public function findOne(){

    }
    public function new(){
        return $this->model->create();
    }

    public function edit() {

    }

    public function update(){

    }

    public function delete(){

    }
}
