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
        $datas = $this->service->findAll();
        $datas->toArray();

        foreach ($datas as $data) {
            $data->due_date = $this->dataFormat($data->due_date);
        }
        /*$datas->toArray();
        $dataFormat = $this->dataFormat($datas[0]['due_date']);
        $datas[1]['dataFormat'] = $dataFormat; */

        /*$datas[0]['dataFormat'] = Carbon::parse($datas[0]['due_date'])->format('d/m/Y'); */
        return view('index', compact(['datas']));

    }
    public function new(){
        return view('create');
    }

    public function create(TaskCreateRequest $request){
        $data = $request->all();
        $this->service->new($data);

        return redirect()->route('tasks.index');
    }

    public function edit(string $id) {
        $datas = $this->service->findOne($id);

        $datas['dataFormat'] = self::dataFormat($datas->due_date);

        return view('edit', compact(['datas']));
    }
    public function update(string $id, TaskCreateRequest $request){
        $data = $request->all();
       /*  dd($data['due_date']); */
        return $this->service->update($id, $data);
    }

    public function detalhe($id){
        $datas = $this->service->findOne($id);
        $datas['dataFormat'] = self::dataFormat($datas->due_date);
        return view('delete', compact('datas'));

    }

    public function delete($id){
        $this->service->destroy($id);
        $datas = $this->service->findAll();

        return redirect()->route('tasks.index', compact('datas'));
    }

    public function dataFormat($datas){
        return $this->service->dataFormat($datas);
    }
}
