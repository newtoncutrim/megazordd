<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\TaskService;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskCreateRequest;
use Illuminate\Database\Eloquent\Collection;

class TaskController extends Controller
{
    public function __construct(protected TaskService $service)
    {}


    public function index(){
        $user = auth()->user();
        $tasks = $user->tasks;

        foreach ($tasks as $task) {
            $task->due_date = $this->dataFormat($task->due_date);
        }

        return view('index', compact(['tasks']));
    }


    public function new(){
        return view('create');
    }

    public function create(TaskCreateRequest $request){
        $data = $request->json()->all();
        $this->service->new($data);

        return response()->json(['message' => 'Tarefa criada com sucesso'], 201);
    }

    public function edit(string $id) {
        $datas = $this->service->findOne($id);

        $datas['dataFormat'] = $this->dataFormat($datas->due_date);

        return view('edit', compact(['datas']));
    }

    public function update(string $id, TaskCreateRequest $request){
        $data = $request->all();
        $this->service->updateTask($data, $id);

        return redirect()->route('tasks.index');
    }

    public function detalhe($id){
        $datas = $this->service->findOne($id);
        $datas['dataFormat'] = $this->dataFormat($datas->due_date);
        return view('delete', compact('datas'));

    }

    public function delete($id){
        $this->service->destroy($id);
        $datas = $this->service->findAll()->sortBy('id')->values();

        foreach ($datas as $index => $task) {
            $task->id = $index + 1;
            $task->save();
        }

        return redirect()->route('tasks.index', compact('datas'));
    }

    public function dataFormat($datas){
        return $this->service->dataFormat($datas);
    }
}
