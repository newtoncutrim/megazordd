<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\UserCreateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserAuthApiController {

    public function login(Request $request){
        $credentials = $request->only(['email', 'password']);
        if(!Auth::attempt($credentials)){
            return Response()->json(["data" => "usuario nao outorizado"], Response::HTTP_NON_AUTHORITATIVE_INFORMATION);
        }

        $token = auth()->user()->createToken('auth_token');

        return response()->json(
            [
                "data" => [
                'token' => $token->plainTextToken
            ]
        ]);
    }

}
