<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Http\Response;

class UserRepository extends AbstractRepository {
    public function __construct(protected User $model)
    {
        $this->model = $model;
    }
}
