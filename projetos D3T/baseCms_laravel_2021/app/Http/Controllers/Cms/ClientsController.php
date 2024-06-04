<?php

namespace App\Http\Controllers\Cms;

use App\Clients;
use App\Helpers\CmsHelper;
use App\Http\Controllers\Cms\RestrictedController;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientsController extends RestrictedController
{
  use UploadTrait;

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $data = $request->all();
    #PAGE TITLE E BREADCRUMBS
    $headers = parent::headers(
      "Clientes",
      [
        [
          "icon" => "",
          "title" => "Clientes",
          "url" => "",
        ],
      ]
    );
    #LISTA DE ITENS
    $titles = json_encode(["#", "Status", "Nome", "E-mail"]);
    $actions = json_encode([
      [
        'path' => '{item}/edit',
        'icon' => 'fa fa-eye',
        'label' => 'Perfil',
        'color' => 'primary',
      ],
    ]);

    $busca = '';
    $pagination = 15;
    if (!empty($data['busca'])) {
      if ($data['busca'] != null && $data['busca'] != '') {
        $busca = $data['busca'];
      }
      $pagination = 500;
    }
    $items = Clients::select('id', 'active', 'name', 'email')
      ->where(function ($query) use ($data) {
        if (!empty($data['busca'])) {
          $query->where('name', 'LIKE', "%" . $data['busca'] . "%");
        }
      })
      ->orWhere(function ($query) use ($data) {
        if (!empty($data['busca'])) {
          $query->where('email', 'LIKE', "%" . $data['busca'] . "%");
        }
      })
      ->orWhere(function ($query) use ($data) {
        if (!empty($data['busca'])) {
          $query->where('id', $data['busca']);
        }
      })
      ->orderBy('id', 'asc')
      ->paginate($pagination);

    foreach ($items as $item) {
      $item['active'] = [
        'type' => 'badge',
        'status' => $item['active'] == 1 ? 'success' : 'danger',
        'text' => $item['active'] == 1 ? 'Ativo' : 'Inativo'
      ];
    }

    return view('cms.clients.index', compact('headers', 'titles', 'items', 'busca', 'actions'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Clients  $clients
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    #PAGE TITLE E BREADCRUMBS
    $headers = parent::headers(
      "Clientes",
      [
        ["icon" => "", "title" => "Clientes", "url" => route('clients.index')],
        ["icon" => "", "title" => "Editar", "url" => ""],
      ]
    );

    $clients = Clients::select(
      'id',
      'active',
      'email as E-mail',
      'name as Nome'      
    )
    ->where('id',$id)->first();

    if (empty($clients)) {
      return redirect()->back();
    }

    $inputs = $clients->toArray();
    unset($inputs['id'],$inputs['active']);
    
    return view('cms.clients.edit', compact('headers', 'clients','inputs'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Clients  $clients
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $data = $request->all();

    $data['active'] = CmsHelper::CheckboxCheck(isset($data['active']));

    $validation = $this->validation($data);
    if ($validation->fails()) {
      return redirect()->back()->withErrors($validation)->withInput();
    }
    $clients = Clients::find($id);
    $clients->update($data);

    return redirect()->route('clients.index')->with('message', 'Registro atualizado com sucesso!');
  }


  private function validation(array $data)
  {
    $validator = [
      'active' => 'nullable|boolean',
    ];

    $messages = [];


    $valid = Validator::make($data, $validator, $messages);


    return $valid;
  }
}
