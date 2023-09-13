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

        return $this->repository->new($data);
    }

    public function findAll(){
        return $this->repository->findAll();
    }

    public function findOne(string $id){
        if(!$this->repository->findOne($id)){
            throw new \Exception('Usuario não encontrado');
        }
        return $this->repository->findOne($id);
    }

    public function delete(string $id){

        if(!$this->repository->delete($id)){
            throw new \Exception("Registro não encontrado");
        }
    }

    public function updateUser($request, string $id){
        $user = $this->findOne($id);
        if(!$user){
            throw new \Exception("usuario inexistente");
        }
        return $this->repository->update($id, $request);
    }
}
