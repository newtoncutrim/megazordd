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

    }

    public function edit() {

    }

    public function update($id, $request){
        if(!$task = $this->model->find($id)){
            return 'nao atualizado';
        }
        $task->update($request);
        return redirect()->route('tasks.index');
    }

    public function delete($id){
        if(!$task = $this->model->find($id)){
            return redirect()->back();
        }
        $task->delete();


        return redirect()->route('tasks.index');
    }
}
