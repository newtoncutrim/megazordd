<?php

namespace App\Repository;

use App\Models\Task;
use App\Repository\Contract\AbstractRepository;

class TaskRepository extends AbstractRepository {
    public function __construct()
    {
        $this->model = new Task();

    }

    public function findTasksForUser($userId){
        return  $this->model->where('user_id', '=', $userId)->get();
    }
}


