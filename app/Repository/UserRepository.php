<?php

namespace App\Repository;

use App\Models\User;
use App\Repository\Contract\AbstractRepository;

class UserRepository extends AbstractRepository {
    public function __construct()
    {
        $this->model = new User();
    }
}
