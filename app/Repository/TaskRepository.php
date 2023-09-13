<?php

namespace App\Repository;

use App\Models\Task;
use App\Repository\Contract\AbstractRepository;

class TaskRepository extends AbstractRepository {
    public function __construct()
    {
        $this->model = new Task();
    }

}


