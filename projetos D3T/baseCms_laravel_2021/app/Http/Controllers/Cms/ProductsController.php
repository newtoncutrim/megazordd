<?php

namespace App\Http\Controllers\Cms;

use App\Product;
use App\FileProduct;
use App\Traits\SlugTrait;
use App\ProductSubCategory;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Cms\RestrictedController;

class ProductsController extends RestrictedController
{
  use UploadTrait;
  use SlugTrait;

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
      "Gerenciar Produtos",
      [
        [
          "icon" => "",
          "title" => "Produtos",
          "url" => "",
        ],
      ]
    );
    #LISTA DE ITENS
    $titles = json_encode(["#", "Titulo", "Imagem", "Ordem"]);
    $actions = json_encode([
      [
        'path' => '{item}/edit',
        'icon' => 'fa fa-pencil',
        'label' => 'Editar',
        'color' => 'primary',
      ],
      [
        'path' => '{item}/stamp', 
        'icon' => 'fa fa-list',
        'label' => 'Listar selos',
        'color' => 'info',
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

    $subcategories = ProductSubCategory::all();
    $items = Product::select('id', 'title', 'image', 'order')
       ->where(function ($query) use ($data) {
        if (!empty($data['busca'])) {
          $query->where('title', 'LIKE', "%" . $data['busca'] . "%");
        }
      })
/*       ->orWhere(function ($query) use ($data) {
        if (!empty($data['busca'])) {
          $query->where('active', 'LIKE', "%" . $data['busca'] . "%");
        }
      })  */
      ->orderBy('order', 'asc')
      ->paginate($pagination);

/*       foreach ($items as $item) {
        if ($item->subCategory) {
          $item->sub_category_id = $item->subCategory->name;
            
        } else {
          $item->sub_category_id = '';
        }
    } */

   /*  dd($items); */
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

    return view('cms.products.index', compact('headers', 'titles', 'items', 'busca', 'actions', 'subcategories'));
  }

  public function show(Request $request, $id){

    dd($request->all(), $id);
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
   /*  dd($data['sub_category_id']); */
    if(empty($data['sub_category_id'])){
      return redirect()->back()->withErrors(['sub categorias' => 'Pelo menos uma categoria deve estar cadastrada'])->withInput();
    }

    $newProduct = Product::create([
      'title' => $data['title'],
      'order' => $data['order'],
      'descriptive' => $data['descriptive'],
      'description' => $data['description'],
      'image' => $data['image'],
      'sub_category_id' => $data['sub_category_id'],
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
  public function edit(Product $product)
  {
    #PAGE TITLE E BREADCRUMBS
    $headers = parent::headers(
      "Produtos - O que a D3T cria",
      [
        ["icon" => "", "title" => "Produtos", "url" => route('products.index')],
        ["icon" => "", "title" => "Editar", "url" => ""],
      ]
    );

/*     $subcategories = $product->subCategory()->first(); */
    $subcategories = ProductSubCategory::all();

    if (empty($product)) {
      return redirect()->back();
    }

    $photoGallery = [];
    $pdfs = [];
    foreach($product->files as $item){
      if($item->gallery != null){
        $photoGallery[] = '/storage/'.$item->gallery;
      }
      if($item->attachments_pdfs != null){
        $pdfs[] = '/storage/'.$item->attachments_pdfs;
      }
    }
    
    /* $product->image = asset($product->image); */
    return view('cms.products.edit', compact('headers', 'product','pdfs', 'photoGallery', 'subcategories'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Product $product)
  {
    $data = $request->all();

    $image_up = '';

    $validation = $this->validation($data, 'update');
    if ($validation->fails()) {
      return redirect()->back()->withErrors($validation)->withInput();
    }

    if (!array_key_exists('image', $data)) {
      $data['image'] = $product->image;
    }
    if (gettype($data['image']) != 'string') {
      if (!empty($data['image'])) {
        if (!$image_up = $this->uploadValidFile('products', $data['image'], 9999)) {
          return redirect()->back()->withErrors(['image' => 'A image não pode ser carregada'])->withInput();
        }
        if (!empty($product->image)) {
          unlink($product->image);
        }
      }
    } else {
      $image_up = $product->image;
    }

    $data['image'] = $image_up;
/* 
    $data['slug'] = $this->getSlug($data['title'], 'products', 'slug', $product->id); */

    $product->update($data);

    /* $newFiles = [];
    if ($request->hasFile('gallery')) {
      $images = FileProduct::where('product_id', $product->id)->pluck('gallery');
      foreach($images as $image){
        $image->delete();
      }
      dd($images);
      foreach ($request->file('gallery') as $gallery) {
        $newFiles[] = [
          'gallery' => $gallery->store('products/gallery'),
          'product_id' => $product->id,
        ];
      }
    } */


/* 
    if ($request->hasFile('attachments_pdfs')) {
      foreach ($request->file('attachments_pdfs') as $pdf) {
        $newFiles[] = [
          'attachments_pdfs' => $pdf->store('products/pdfs'),
          'product_id' => $product->id,
        ];
      }
    }

    foreach ($newFiles as $fileData) {
      FileProduct::create($fileData);
    } */
    $product->image = asset($product->image);

    return redirect()->route('products.index')->with('message', 'Registro atualizado com sucesso!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $data = $request->all();

    if (isset($data['registro'])) {
      $product = Product::whereIn('id', $data['registro'])->get();
      foreach ($product as $product) {
        if (!empty($product->image)) {
          unlink($product->image);
        }
        $product->delete();
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
      'active' => 'nullable|boolean',
      'highlight' => 'nullable|boolean',
      'title' => 'nullable|string|max:250',
      'order' => 'required|integer',
      'sub_category_id' => 'required',
    ];

    $messages = [
      'sub_category_id.required' => 'A subcategoria é obrigatória.',
      'title.max' => 'O número máximo de caracteres é de 250',
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
