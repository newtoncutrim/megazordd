<?php

namespace App\Repository;

use App\Models\User;


class UserRepository implements UserInterface {
    public function __construct(protected User $model)
    {}

    public function register($data){
        $this->model->create($data);
        return redirect()->route('user.login');

    }
}
