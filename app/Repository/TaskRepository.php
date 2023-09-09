<?php

namespace App\Repository;

use App\Models\Task;
use App\Repository\TaskInterface;
use Illuminate\Support\Facades\DB;

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
        $this->model->create($data);
        return redirect()->back();

    }

    public function edit() {

    }

    public function update($id, $request){
        $task = $this->model->find($id);
        $task->update($request);

        return redirect()->route('tasks.index');
    }

    public function delete($id){
        $task = $this->model->find($id);
        $task->delete();

        $records = DB::table('tasks')->get();

        // Reordena os IDs
        $newId = 1;
        foreach ($records as $record) {
            DB::table('tasks')->where('id', $record->id)->update(['id' => $newId]);
        $newId++;
    }

        return redirect()->route('tasks.index');
    }


}


