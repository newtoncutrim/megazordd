<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Services\UserService;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct(protected UserService $service)
    {}

    public function register(){
        return Inertia::render("Users/Teste");
    }

    public function signup(UserCreateRequest $request){

        return $this->service->register($request);
    }

    public function login(){
        return view('user.login');
    }

    public function sigin(){

    }

    public function auth(Request $request){
        $credentials = $request->only(['email', 'password']);

        if(auth()->attempt($credentials)){
            return redirect()->intended('tasks');
        }

        return redirect()->back()->withErrors(['Usuario ou senha inavlida.']);

    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('user.login');
    }
}
