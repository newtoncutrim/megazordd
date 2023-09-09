<?php

namespace App\Services;

use App\Repository\UserRepository;

class UserService {
    public function __construct(protected UserRepository $repository)
    {}

    public function register($request){
        if(!$data = $request->all()){
            return 'nao cadastrado';
        }

        return $this->repository->register($data);
    }
}
