<?php

namespace App\Http\Controllers\Cms;

use App\Product;
use App\FileProduct;
use App\Traits\SlugTrait;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Cms\RestrictedController;
use App\ProductStamp;

class ProductStampsController extends RestrictedController
{
  use UploadTrait;
  use SlugTrait;

  public function index(Request $request, $id){
    $data = $request->all();
    #PAGE TITLE E BREADCRUMBS
    $product = Product::find($id);
    $headers = parent::headers(
      "Selos",
      [
        [
          "icon" => "",
          "title" => "Produtos",
          "url" => "",
        ],
      ]
    );
    #LISTA DE ITENS
    $titles = json_encode(["#", "Nome", "Imagem"]);
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
   
    $items = ProductStamp::select('id', 'name', 'image')->where('product_id', $id)
     /*  ->where(function ($query) use ($data) {
        if (!empty($data['busca'])) {
          $query->where('title', 'LIKE', "%" . $data['busca'] . "%");
        }
      })
      ->orWhere(function ($query) use ($data) {
        if (!empty($data['busca'])) {
          $query->where('active', 'LIKE', "%" . $data['busca'] . "%");
        }
      }) */
   /*    ->orderBy('order', 'asc') */
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
    }

    /* foreach ($items as $item) {
      $item['active'] = [
        'type' => 'badge',
        'status' => $item['active'] == 1 ? 'success' : 'danger',
        'text' => $item['active'] == 1 ? 'Ativo' : 'Inativo'
      ];
      $item['highlight'] = [
        'type' => 'badge',
        'status' => $item['highlight'] == 1 ? 'success' : 'danger',
        'text' => $item['highlight'] == 1 ? 'Ativo' : 'Inativo'
      ];
    } */

    return view('cms.products.selos.index', compact('headers', 'titles', 'items', 'busca', 'actions', 'product'));
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

    $validation = $this->validation($data, 'store');
    if ($validation->fails()) {
      return redirect()->back()->withErrors($validation)->withInput();
    }

    if (empty($data['image'])) {
      return redirect()->back()->withErrors(['images' => 'Pelo menos um campo de imagem deve ser preenchido'])->withInput();
    } else {
      if (!empty($data['image'])) {
        if (!$image = $this->uploadValidFile('products', $data['image'], 9999)) {
          return redirect()->back()->withErrors(['image' => 'O imagem não pode ser carregado'])->withInput();
        }
      }
    }

    $data['image'] = !empty($image) ? $image : '';


    $newProduct = ProductStamp::create([
      'name' => $data['name'],
      'image' => $data['image'],
      'product_id' => $id,
    ]);
    
/*     $newFiles = [];
    foreach($data['gallery'] as $gallery){
      foreach($data['attachments_pdfs'] as $pdfs){
        $newFiles = [
          'galery' => Storage::url($gallery->store('products/gallery')),
          'attachments_pdfs' => Storage::url($pdfs->store('products/pdfs')),
          'product_id' => $newProduct->id,
        ];
      }
    }
    FileProduct::create($newFiles); */
    $newFiles = [];
    if ($request->hasFile('gallery')) {
      foreach ($request->file('gallery') as $gallery) {
        $newFiles[] = [
          'gallery' => $gallery->store('products/gallery'),
          'product_id' => $newProduct->id,
        ];
      }
    }

    if ($request->hasFile('attachments_pdfs')) {
      foreach ($request->file('attachments_pdfs') as $pdf) {
        $newFiles[] = [
          'attachments_pdfs' => $pdf->store('products/pdfs'),
          'product_id' => $newProduct->id,
        ];
      }
    }

    // Salva os registros de arquivos no banco
    foreach ($newFiles as $fileData) {
      FileProduct::create($fileData);
    }

    $newProduct->image = asset($newProduct->image);

    return redirect()->back()->with('message', 'Registro cadastrado com sucesso!');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function edit( $id_product, $item_stamp)
  {
    $stamp = ProductStamp::find($item_stamp);
    #PAGE TITLE E BREADCRUMBShttp://localhost:82/cms/clients
    $headers = parent::headers(
      "Selos",
      [
        ["icon" => "", "title" => "Produtos", "url" => route('products.stamp.edit', [$id_product, $item_stamp])],
        ["icon" => "", "title" => "Editar", "url" => ""],
      ]
    );
    if (empty($stamp)) {
      return redirect()->back();
    }

    return view('cms.products.selos.edit', compact('headers', 'id_product', 'stamp'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $product, $id)
  {
    $data = $request->all();
    $image_up = '';

    $stamp = ProductStamp::find($id);

    $validation = $this->validation($data, 'update');
    if ($validation->fails()) {
      return redirect()->back()->withErrors($validation)->withInput();
    }

    if (!array_key_exists('image', $data)) {
      $data['image'] = $stamp->image;
    }
    if (gettype($data['image']) != 'string') {
      if (!empty($data['image'])) {
        if (!$image_up = $this->uploadValidFile('products', $data['image'], 9999)) {
          return redirect()->back()->withErrors(['image' => 'A image não pode ser carregada'])->withInput();
        }
        if (!empty($stamp->image)) {
          unlink($stamp->image);
        }
      }
    } else {
      $image_up = $stamp->image;
    }

    $data['image'] = $image_up;
    $stamp->update([
      'name' => $data['name'],
      'image' => $data['image']
    ]);

    return redirect()->route('products.stamp.index', $product)->with('message', 'Registro atualizado com sucesso!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $data = $request->all();

    if (isset($data['registro'])) {
      $stamp = ProductStamp::whereIn('id', $data['registro'])->get();
      foreach ($stamp as $stamp) {
        if (!empty($stamp->image)) {
          unlink($stamp->image);
        }
        $stamp->delete();
      }      
      return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
    } else {
      return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
    }
  }

  public function messages()
  {
    return [
      'validation.image' => 'A imagem não pode ser carregado'
    ];
  }

  private function validation(array $data, $funtction)
  {
    $validator = [
      'image' => 'nullable|file',
/*       'active' => 'nullable|boolean',
      'highlight' => 'nullable|boolean', */
      'name' => 'nullable|string|max:250',
/*       'order' => 'required|integer' */
    ];

    $messages = [
      'name.max' => 'O número máximo de caracteres é de 250',
      'image' => 'A imagem não pode ser carregada',
      'image.required' => 'Pelo menos o campo de imagem precisa ser preenchido',
      'order.required' => 'É necessário escolher uma ordem'
    ];

    $valid = Validator::make($data, $validator, $messages);

    if ($funtction != 'update') {
      $valid->sometimes('image', 'required', function ($input) {
        if (empty($input->image) || $input->image == '' || $input->image == null) {
          return true;
        }
      });
    }

    return $valid;
  }
}
