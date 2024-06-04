<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Cms\RestrictedController;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Service;
use App\ServiceOptions;
use App\Traits\SlugTrait;

class ServicesOptionsController extends RestrictedController
{
  use SlugTrait;

  public function index(Request $request, $id)
  {
    $service = Service::find($id);

    $data = $request->all();

    $headers = parent::headers(
      "Opções de vantagens do serviço",
      [
        [
          "icon" => "",
          "title" => "Opções de vantagens do serviço",
          "url" => ""
        ]
      ]
    );

    $titles = json_encode(['#', 'Nome']);
    $actions = json_encode([
      [
        'path' => '{item}/edit',
        'icon' => 'fa fa-pencil',
        'label' => 'editar',
        'color' => 'primary'
      ]
    ]);

    $busca = '';
    $pagination = 15;
    if (!empty($data['busca'])) {
      if ($data['busca'] != null && $data['busca'] != '') {
        $busca = $data['busca'];
      }
      $pagination = 500;
    }
    $items = ServiceOptions::select('id', 'name')
      ->where('service_id', $service['id'])
      ->where(function ($query) use ($data) {
        if (!empty($data['busca'])) {
          $query->where('name', 'LIKE', "%" . $data['busca'] . "%");
        }
      })
      ->paginate($pagination);

    return view("cms.services.options.index", compact('headers', 'titles', 'items', 'actions', 'busca', 'service'));
  }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $id)
  {
    $data = $request->all();
    $data['service_id'] = $id;
    $validation = $this->validation($data);
    if ($validation->fails()) {
      return redirect()->back()->withErrors($validation)->withInput();
    }
    // pegar o id do serviço aqui
    ServiceOptions::create($data);

    return redirect()->back()->with('message', 'Registro cadastrado com sucesso!');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\ServiceOptions  $service_option
   * @return \Illuminate\Http\Response
   */
  public function edit($service, $option)
  {
    $option_item = ServiceOptions::find($option);
    #PAGE TITLE E BREADCRUMBS
    $headers = parent::headers(
      "Opções de vantagens do serviço",
      [
        ["icon" => "", "title" => "Opções de vantagens do serviço", "url" => route('services.options.edit', [$service, $option])],
        ["icon" => "", "title" => "Editar", "url" => ""],
      ]
    );

    if (empty($option_item)) {
      return redirect()->back();
    }

    return view('cms.services.options.edit', compact('headers', 'service', 'option_item'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\ServiceOptions  $service_option
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $service, $id)
  {
    $data = $request->all();
    $validation = $this->validation($data);
    if ($validation->fails()) {
      return redirect()->back()->withErrors($validation)->withInput();
    }

    $service_option = ServiceOptions::find($id);

    $service_option->update($data);

    return redirect()->route('services.options.index', [$service, $id])->with('message', 'Registro atualizado com sucesso!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\ServiceOptions  $service_option
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $data = $request->all();
    $options = ServiceOptions::whereIn('id', $data['registro'])->get();
    foreach ($options as $option) {
      $option->delete();
    }


    return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
  }

  private function validation(array $data)
  {
    $validator = [
      'name' => 'required|string|max:250'
    ];

    $messages = [
      'name.required' => 'É necessário um nome para a opção',
      'name.max' => 'O número máximo de caracteres é de 250'
    ];

    return Validator::make($data, $validator, $messages);
  }
}