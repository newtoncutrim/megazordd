<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements InterfaceRepository {

    protected Model $model;

    public function findAll(){
        return $this->model->all();
    }

    public function findOne($id){
        return $this->model->find($id);
    }
    public function new($data){
        $this->model->create($data);
        return redirect()->back();

    }

    public function edit() {

    }

    public function update($id, $request){
        $task = $this->model->find($id);
        $task->update($request);
        /* DB::transaction(); */
    }

    public function delete($id){
        $task = $this->model->find($id);
        $task->delete();

        $records = $this->model->get();

        // Reordena os IDs

        return $records;
    }
}
