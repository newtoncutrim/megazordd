<?php

namespace App\Repository;

use App\Models\User;


class UserRepository implements UserInterface {
    public function __construct(protected User $model)
    {}

    public function register($request){
        $data = $request->all();
        if($this->model->create($data)){
            return redirect()->route('user.login');
        }
        return 'nao cadastrado';

    }
}
