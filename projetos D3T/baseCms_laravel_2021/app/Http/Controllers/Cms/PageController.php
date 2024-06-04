<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
Use App\Http\Controllers\Cms\RestrictedController;
use Illuminate\Validation\Rule;

use App\Page;

use App\Traits\UploadTrait;

class PageController extends RestrictedController
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
      "Páginas",
      [
        [
          "icon" => "",
          "title" => "Páginas",
          "url" => ""
        ]
      ]
    );
     #LISTA DE ITENS
    $titles = json_encode(["#", 'Status','Título', "Local"]);
    $actions = json_encode([
      [
        'path' => '{item}/edit',
        'icon' => 'fa fa-pencil',
        'label' => 'Editar',
        'color' => 'primary'
      ]
    ]);
    
    $busca = '';
    $pagination = 15;
    if(!empty($data['busca'])){
      if($data['busca'] != null && $data['busca'] != ''){
        $busca = $data['busca'];
      }
      $pagination = 500;
    }
    $items = Page::select('id', 'active','name', 'location')
    ->paginate($pagination);

    foreach ($items as $item) {
      $item['active'] = [
        'type' => 'badge',
        'status' => $item['active'] == 1 ? 'success' : 'danger',
        'text' => $item['active'] == 1 ? 'Ativo' : 'Inativo'
      ];
    }

    return view('cms.pages.index', compact('headers', 'titles', 'items', 'actions', 'busca'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Page  $page
   * @return \Illuminate\Http\Response
   */
  public function edit(Page $page)
  {
    #PAGE TITLE E BREADCRUMBS
    $headers = parent::headers(
      "Páginas",
      [
        ["icon" => "", "title" => "Páginas", "url" => route('pages.index')],
        ["icon" => "", "title" => "Editar", "url" => ""],
      ]
    );

    if (empty($page)) {
      return redirect()->back();
    }

    $address = ['cep' => $page->CEP, 'state' => $page->state, 'city' => $page->city, 'street' => $page->street, 'number' => $page->number];
    $address = json_encode($address);
    
    return view('cms.pages.edit', compact('headers', 'page', 'address'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Page  $page
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Page $page)
  {
    $data = $request->all();
    unset($data['location']);
    $validation = $this->validation($data);
    if ($validation->fails()) {
      return redirect()->back()->withErrors($validation)->withInput();
    }

    $image = '';
    if (!empty($page->image)) {
      $image = $page->image;
    }
    if ($request->hasFile('image')) {
      if (!$image = $this->uploadValidFile('pages', $data['image'], 800)) {
        return redirect()->back()->withErrors(['errors' => 'image cannot be uploaded'])->withInput();
      }

      if(File::exists($page->image)) {
        unlink($page->image);
      }
    }

    if (!isset($data['active'])) {
      $data['active'] = 0;
    }

    if(in_array($page->id, [1,2,3,4,5,6,7])){
      $data['active'] = 1;
    }

		if (!empty($data['video'])) {
			$data['video'] = str_replace("watch?v=", "embed/", $data["video"]);
		}

    $data['image'] = $image != '' ? $image : NULL;

    $page->update($data);

    return redirect()->route('pages.index')->with('message', 'Registro atualizado com sucesso!');
  }

  private function validation(array $data)
  {
    $validator = [
      'name' => 'nullable|string|max:250',
      'description' => 'nullable|string',
			'facebook' => 'nullable|string',
			'whatsapp' => 'nullable|string',
			'instagram' => 'nullable|string',
			'item' => 'nullable|string',
			'street' => 'nullable|string',
			'CEP' => 'nullable|string',
			'cnpj' => 'nullable|string',
			'city' => 'nullable|string',
			'state' => 'nullable|string',
			'number' => 'nullable|numeric',
			'district' => 'nullable|string',
			'video' => 'nullable|string',
			'phone' => 'numeric|string',
      'image' => 'nullable|image',
    ];
    return Validator::make($data, $validator);
  }
}
