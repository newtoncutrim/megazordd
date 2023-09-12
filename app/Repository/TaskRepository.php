<?php

namespace App\Repository;

use App\Models\Task;
use App\Repository\TaskInterface;
use Illuminate\Support\Facades\DB;

class TaskRepository extends AbstractRepository {
    public function __construct()
    {
        $this->model = new Task();
    }

}


