<?php

namespace App\Services;

use App\Clients;
use App\JWTauth;
use Illuminate\Support\Facades\DB;

class AuthenticationService
{
    public static function validaUsuario($email)
    {
        return Clients::where('email', $email)->first();
    }

    public function novoUsuario($data)
    {
        try {
            DB::beginTransaction();
            $data['email'] = strtolower($data['email']);
            $data['password'] = bcrypt($data['password']);
            Clients::create($data);
            JWTauth::create($data);
            DB::commit();
            return ['status' => true, 'msg' => 'Conta criada com sucesso!'];
        } catch (\Throwable $th) {
            DB::rollBack();
            return ['status' => false, 'msg' => 'Não foi possivel realizar o cadastro. Recarregue a página e tente novamente.'];
        }
    }
}
