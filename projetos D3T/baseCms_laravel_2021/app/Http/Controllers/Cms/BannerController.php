<?php

namespace App\Http\Controllers\Cms;

use Log;
use App\Banner;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Cms\RestrictedController;

class BannerController extends RestrictedController
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
      "Banners",
      [
        [
          "icon" => "",
          "title" => "Banner",
          "url" => "",
        ],
      ]
    );
    #LISTA DE ITENS
    $titles = json_encode(["#", "Status", "name", "Imagem", "Imagem Mobile"]);
    $actions = json_encode([
      [
        'path' => '{item}/edit',
        'icon' => 'fa fa-pencil',
        'label' => 'Editar',
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
    $items = Banner::select('id', 'active', 'name', 'image', 'image_mobile')
      ->where(function ($query) use ($data) {
        if (!empty($data['busca'])) {
          $query->where('title', 'LIKE', "%" . $data['busca'] . "%");
        }
      })
      ->orWhere(function ($query) use ($data) {
        if (!empty($data['busca'])) {
          $query->where('active', 'LIKE', "%" . $data['busca'] . "%");
        }
      })
      ->orderBy('created_at')
      ->paginate($pagination);

    foreach ($items as $key => $value) {
      if (!empty($items[$key]->image)) {
        $items[$key]->image = [
          "type" => 'img',
          "src" => asset($value->image)
        ];
      } else {
        $items[$key]->image = 'Não possui';
      }
      if (!empty($items[$key]->image_mobile)) {
        $items[$key]->image_mobile = [
          "type" => 'img',
          "src" => asset($value->image_mobile)
        ];
      } else {
        $items[$key]->image_mobile = 'Não possui';
      }
    }

    foreach ($items as $item) {
      $item['active'] = [
        'type' => 'badge',
        'status' => $item['active'] == 1 ? 'success' : 'danger',
        'text' => $item['active'] == 1 ? 'Ativo' : 'Inativo'
      ];
    }

    return view('cms.banner.index', compact('headers', 'titles', 'items', 'busca', 'actions'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $data = $request->all();
    /* dd($data); */
    if (!isset($data['active'])) {
      $data['active'] = 0;
    }

    $validation = $this->validation($data, 'store');
    if ($validation->fails()) {
      return redirect()->back()->withErrors($validation)->withInput();
    }

    if (empty($data['image'])) {
      return redirect()->back()->withErrors(['images' => 'Pelo menos um campo de imagem deve ser preenchido'])->withInput();
    } else {
      if (!empty($data['image'])) {
        if (!$image = $this->uploadValidFile('banner', $data['image'], 2000)) {
          return redirect()->back()->withErrors(['image' => 'A image não pode ser carregada'])->withInput();
        }
      }
    }

    $data['image'] = !empty($image) ? $image : '';

    if (empty($data['image_mobile'])) {
      return redirect()->back()->withErrors(['images' => 'Pelo menos um campo de imagem deve ser preenchido'])->withInput();
    } else {
      if (!empty($data['image_mobile'])) {
        if (!$image_mobile = $this->uploadValidFile('banner', $data['image_mobile'], 1920)) {
          return redirect()->back()->withErrors(['image_mobile' => 'A image não pode ser carregada'])->withInput();
        }
      }
    }

    $data['image_mobile'] = !empty($image_mobile) ? $image_mobile : '';

    $newBanner = Banner::create($data);
    $newBanner->image = asset($newBanner->image);
    $newBanner->image_mobile = asset($newBanner->image_mobile);

    return redirect()->back()->with('message', 'Registro cadastrado com sucesso!');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Banner  $banner
   * @return \Illuminate\Http\Response
   */
  public function edit(Banner $banner)
  {
    #PAGE TITLE E BREADCRUMBS
    $headers = parent::headers(
      "banner",
      [
        ["icon" => "", "title" => "Banner", "url" => route('banner.index')],
        ["icon" => "", "title" => "Editar", "url" => ""],
      ]
    );

    if (empty($banner)) {
      return redirect()->back();
    }
    return view('cms.banner.edit', compact('headers', 'banner'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Banner  $banner
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Banner $banner)
  {
    $data = $request->all();
    $image_up = '';
    $image_mobile_up = '';

    if (!isset($data['active'])) {
      $data['active'] = 0;
    }

    $validation = $this->validation($data, 'update');
    if ($validation->fails()) {
      return redirect()->back()->withErrors($validation)->withInput();
    }

    if (!array_key_exists('image', $data)) {
      $data['image'] = $banner->image;
    }
    if (!array_key_exists('image_mobile', $data)) {
      $data['image_mobile'] = $banner->image_mobile;
    }
    if (gettype($data['image']) != 'string') {
      if (!empty($data['image'])) {
        if (!$image_up = $this->uploadValidFile('banner', $data['image'], 1920)) {
          return redirect()->back()->withErrors(['image' => 'A imagem não pode ser carregada'])->withInput();
        }
        if (!empty($banner->image)) {
          unlink($banner->image);
        }
      }
    } else {
      $image_up = $banner->image;
    }

    $data['image'] = $image_up;

    if (gettype($data['image_mobile']) != 'string') {
      if (!empty($data['image_mobile'])) {
        if (!$image_mobile_up = $this->uploadValidFile('banner', $data['image_mobile'], 1920)) {
          return redirect()->back()->withErrors(['image_mobile' => 'A imagem mobile não pode ser carregada'])->withInput();
        }
        if (!empty($banner->image_mobile)) {
          unlink($banner->image_mobile);
        }
      }
    } else {
      $image_mobile_up = $banner->image_mobile;
    }

    $data['image_mobile'] = $image_mobile_up;

    $banner->update($data);

    $banner->image = asset($banner->image);
    $banner->image_mobile = asset($banner->image_mobile);

    return redirect()->route('banner.index')->with('message', 'Registro atualizado com sucesso!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Banner  $banner
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $data = $request->all();

    if (isset($data['registro'])) {
      $banner = Banner::whereIn('id', $data['registro'])->get();
      foreach ($banner as $banner) {
        if (!empty($banner->image)) {
          $url = str_replace('storage/banner/', '', $banner->image);
          if (file_exists(storage_path('app/public/banner/' . $url))) {
            unlink(storage_path('app/public/banner/' . $url));
          }
      }

      if (!empty($banner->image_mobile)) {
        $url = str_replace('storage/banner/', '', $banner->image_mobile);
        if (file_exists(storage_path('app/public/banner/' . $url))) {
          unlink(storage_path('app/public/banner/' . $url));
        }
      }

      $banner->delete();
    }    
      return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
    } else {
      return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
    }
  }

  public function messages()
  {
    return [
      'validation.image' => 'A imagem não pode ser carregada'
    ];
  }

  private function validation(array $data, $funtction)
  {
    $validator = [
      'image' => 'nullable|image',
      'link' => 'nullable|string',
      'active' => 'nullable|boolean',
      'name' => 'nullable|string|max:250',
    ];

    $messages = [
      'title.max' => 'O número máximo de caracteres é de 250',
      'image' => 'A imagem não pode ser carregada',
      'image.required' => 'Pelo menos um dos campos de imagem precisa ser preenchido',
      'description.required' => 'É necessário preencher a descrição',
      'button.max' => 'O número máximo de caracteres é de 150',
      'turn.required' => 'É necessário escolher uma ordem'
    ];

    /* $data['description'] = strip_tags($data['description']) != '' ? $data['description'] : ''; */

/*     if ($data['button'] != '') {
      $validator['link'] = 'required|string';
      $messages['link.required'] = 'Para um cadastrar um botão, é necessário um título E link';
    }
    if ($data['link'] != '') {
      $validator['button'] = 'required|string';
      $messages['button.required'] = 'Para um cadastrar um botão, é necessário um link E título';
    } */

    $valid = Validator::make($data, $validator, $messages);

    if ($funtction != 'update') {
      $valid->sometimes('image', 'required', function ($input) {
        if (empty($input->image) || $input->image == '' || $input->image == null) {
          return true;
        }
      });
      $valid->sometimes('image_mobile', 'required', function ($input) {
        if (empty($input->image_mobile) || $input->image_mobile == '' || $input->image_mobile == null) {
          return true;
        }
      });
    }

    return $valid;
  }
}
