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
        $datas = $this->service->findAll();

        return view('index', compact('datas'));

    }
    public function new(){
        return view('create');
    }

    public function create(TaskCreateRequest $request){
        $data = $request->all();
        $this->service->new($data);

        return redirect()->route('tasks.index');
    }

    public function edit($id) {
        $datas = $this->service->findOne($id);
        return view('edit', compact('datas'));
    }
    public function update($id, TaskCreateRequest $request){
        $data = $request->all();
        return $this->service->update($id, $data);
    }

    public function detalhe($id){
        $datas = $this->service->findOne($id);
        return view('delete', compact('datas'));

    }

    public function delete($id){
        $this->service->destroy($id);
        $datas = $this->service->findAll();
        return redirect()->route('tasks.index', compact('datas'));
    }
}
