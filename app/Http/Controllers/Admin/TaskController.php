<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskCreateRequest;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected TaskService $service)
    {}

    public function index(){
        $data = $this->service->findAll();

        return view('index', compact('data'));

    }
    public function new(){
        return view('create');
    }

    public function create(TaskCreateRequest $request){
        dd($request);
        return $this->service->new($request);
    }

    public function edit() {

    }
    public function update(){

    }

    public function delete(){

    }
}
