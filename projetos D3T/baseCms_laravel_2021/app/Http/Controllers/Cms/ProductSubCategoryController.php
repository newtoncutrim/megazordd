<?php

namespace App\Http\Controllers\Cms;

use App\Product;
use App\FileProduct;
use App\Traits\SlugTrait;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Cms\RestrictedController;
use App\ProductCategory;
use App\ProductSubCategory;

class ProductSubCategoryController extends RestrictedController
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
      "Sub Categoria",
      [
        [
          "icon" => "",
          "title" => "Produtos",
          "url" => "",
        ],
      ]
    );
    #LISTA DE ITENS
    $titles = json_encode(["#", "Nome"]);
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
    $categories = ProductCategory::all();
    $items = ProductSubCategory::select('id', 'name')
       ->where(function ($query) use ($data) {
        if (!empty($data['busca'])) {
          $query->where('name', 'LIKE', "%" . $data['busca'] . "%");
        }
      })
      /* ->orWhere(function ($query) use ($data) {
        if (!empty($data['busca'])) {
          $query->where('active', 'LIKE', "%" . $data['busca'] . "%");
        }
      }) */
   /*    ->orderBy('order', 'asc') */
      ->paginate($pagination);

/*     foreach ($items as $key => $value) {
      if (!empty($items[$key]->image)) {
        $items[$key]->image = [
          "type" => 'img',
          "src" => asset($value->image)
        ];
      } else {
        $items[$key]->image = 'Não possui';
      }
    } */

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

    return view('cms.products.sub-categorias.index', compact('headers', 'titles', 'items', 'busca', 'actions', 'categories'));
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

    ProductSubCategory::create($data);


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
        ["icon" => "", "title" => "Produtos", "url" => route('products_sub_category.index')],
        ["icon" => "", "title" => "Editar", "url" => ""],
      ]
    );

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
    return view('cms.products.sub-categorias.edit', compact('headers', 'product','pdfs', 'photoGallery'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Product  $product
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $data = $request->all();
   /*  dd($data); */
   $sub_category = ProductSubCategory::where('id', $id)->first();


/*     if (!isset($data['active'])) {
      $data['active'] = 0;
    }

    if (!isset($data['highlight'])) {
      $data['highlight'] = 0;
    } */

/*     $validation = $this->validation($data, 'update');
    if ($validation->fails()) {
      return redirect()->back()->withErrors($validation)->withInput();
    }


    $data['image'] = $image_up; */
/* 
    $data['slug'] = $this->getSlug($data['title'], 'products', 'slug', $product->id); */

    $sub_category->update($data);

    return redirect()->route('products_sub_category.index')->with('message', 'Registro atualizado com sucesso!');
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
      $product = ProductSubCategory::whereIn('id', $data['registro'])->get();
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

/*   public function messages()
  {
    return [
      'validation.image' => 'A imagem não pode ser carregado'
    ];
  } */

  private function validation(array $data, $funtction)
  {
    $validator = [
/*       'image' => 'nullable|file',
      'active' => 'nullable|boolean',
      'highlight' => 'nullable|boolean' */
      'name' => 'nullable|string|max:250',
/*       'order' => 'required|integer' */
    ];

    $messages = [
      'name.max' => 'O número máximo de caracteres é de 250',
/*       'image' => 'A imagem não pode ser carregada',
      'image.required' => 'Pelo menos o campo de imagem precisa ser preenchido',
      'order.required' => 'É necessário escolher uma ordem' */
    ];

    $valid = Validator::make($data, $validator, $messages);

    /* if ($funtction != 'update') {
      $valid->sometimes('image', 'required', function ($input) {
        if (empty($input->image) || $input->image == '' || $input->image == null) {
          return true;
        }
      });
    } */

    return $valid;
  }
}
