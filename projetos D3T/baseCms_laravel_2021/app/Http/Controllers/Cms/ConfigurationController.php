<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
Use App\Http\Controllers\Cms\RestrictedController;
use Illuminate\Validation\Rule;
use App\Configurations;

use App\Traits\UploadTrait;

class ConfigurationController extends RestrictedController
{
  use UploadTrait;

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Configurations  $configurations
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    #configurations TITLE E BREADCRUMBS
    $headers = parent::headers(
      "Configurações",
      [
        ["icon" => "", "title" => "Configurações", "url" => route('configurations.index')],
      ]
    );

    $configurations = Configurations::find(1);

    return view('cms.configurations.edit', compact('headers', 'configurations'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Configurations  $configurations
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $configurations)
  {
    $data = $request->all();
    $validation = $this->validation($data);
    $configurations = Configurations::find($configurations);
    if ($validation->fails()) {
      return redirect()->back()->withErrors($validation)->withInput();
    }
    $configurations->update($data);

    return redirect()->route('configurations.index')->with('message', 'Registro atualizado com sucesso!');
  }

  private function validation(array $data)
  {
    $validator = [
      'title' => 'required|string|max:100',
      'description' => 'required|string',
      'whatsapp' => 'required|string|min:14|max:15',
      'facebook' => 'required|string|url',
      'instagram' => 'required|string|url',
      'linkedin' => 'required|string|url',
      'form_email' => 'required|string|email',
      'email' => 'required|email|string',
      'keywords' => 'required|string'
    ];

    $messages = [
      'title.required' => 'É necessário colocar um nome',
      'title.max' => 'Máximo 100 caracteres',
      'description.required' => 'É necessário preencher a descrição',
      'description.max' => 'Máximo de 250 caracteres',
      'whatsapp.min' => 'Número ínvalido',
      'whatsapp.max' => 'Número ínvalido',
      'whatsapp.required' => 'É necessário preencher o Whatsapp',
      'facebook.required' => 'É necessário preencher o Facebook',
      'instagram.required' => 'É necessário preencher o Instagram',
      'linkedin.required' => 'É necessário preencher o Linkedin',
      'form_email.required' => 'É necessário preencher o e-mail',
      'email.required' => 'É necessário preencher o e-mail',
      'email.email' => 'Insira um e-mail',
      'form_email' => 'Insira um e-mail',
      'keywowrd.required' => 'É necessário preencher pelo menos uma palavra-chave'
    ];
    $data['description'] = strip_tags($data['description']) != '' ? $data['description'] : '';

    return Validator::make($data, $validator,$messages);
  }
}
