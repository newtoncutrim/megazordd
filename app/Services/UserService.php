<?php

namespace App\Services;

use App\Repository\UserRepository;

class UserService {
    public function __construct(protected UserRepository $repository)
    {}

    public function register($request){
        return $this->repository->register($request);
    }
}
