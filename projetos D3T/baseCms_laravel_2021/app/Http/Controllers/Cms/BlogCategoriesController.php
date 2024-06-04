<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
Use App\Http\Controllers\Cms\RestrictedController;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\BlogCategories;
use App\BlogPosts;
use App\BlogGallery;
use App\Traits\SlugTrait;

class BlogCategoriesController extends RestrictedController
{
  use SlugTrait;

  public function index(Request $request)
  {
    $data = $request->all();
    $headers = parent::headers(
      "Categorias do blog",
      [
        [
          "icon" => "",
          "title" => "Categorias do blog",
          "url" => ""
        ]
      ]
    );

    $titles = json_encode(['#', 'Status','Nome']);
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
    if(!empty($data['busca'])){
      if($data['busca'] != null && $data['busca'] != ''){
        $busca = $data['busca'];
      }
      $pagination = 500;
    }
    $items = BlogCategories::select('id', 'active', 'name')
    ->where(function ($query) use ($data) {
      if (!empty($data['busca'])) {
        $query->where('name', 'LIKE', "%".$data['busca']."%");
      }
    })
	->orWhere(function ($query) use ($data) {
        if (!empty($data['busca'])) {
          $query->where('active', 'LIKE', "%" . $data['busca'] . "%");
        }
      })
    ->paginate($pagination);

	foreach ($items as $item) {
		$item['active'] = [
		  'type' => 'badge',
		  'status' => $item['active'] == 1 ? 'success' : 'danger',
		  'text' => $item['active'] == 1 ? 'Ativo' : 'Inativo'
		];
	  }

    return view("cms.blog.categories.index", compact('headers', 'titles', 'items', 'actions', 'busca'));
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
	if (!isset($data['active'])) {
		$data['active'] = 0;
	  }
    $validation = $this->validation($data);
    if ($validation->fails()) {
      return redirect()->back()->withErrors($validation)->withInput();
    }

    $data['slug'] = $this->getSlug($data['name'], 'blog_categories');

    BlogCategories::create($data);

    return redirect()->back()->with('message', 'Registro cadastrado com sucesso!');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\BlogCategories  $post_category
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $post_category = BlogCategories::find($id);
    #PAGE TITLE E BREADCRUMBS
    $headers = parent::headers(
      "Categorias do blog",
      [
        ["icon" => "", "title" => "Categoria do blog", "url" => route('blog_categories.index')],
        ["icon" => "", "title" => "Editar", "url" => ""],
      ]
    );

    if (empty($post_category)) {
      return redirect()->back();
    }

    return view('cms.blog.categories.edit', compact('headers', 'post_category'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\BlogCategories  $post_category
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $data = $request->all();
	if (!isset($data['active'])) {
		$data['active'] = 0;
	  }
    $validation = $this->validation($data);
    if ($validation->fails()) {
      return redirect()->back()->withErrors($validation)->withInput();
    }

    $post_category = BlogCategories::find($id);

    $postActive = DB::table('blog_posts')->join('blog_categories','blog_categories.id','=', 'blog_posts.blog_category_id')
    ->where('blog_posts.blog_category_id', $id)
    ->select('blog_posts.id', 'blog_posts.active')->get();

    foreach ($postActive as $actives){
        if ($actives->active != $data['active']){
          $actives->active = '0';
          $active = ['active'=>$actives->active];
          $postStatus = BlogPosts::find($actives->id);
          $postStatus->update($active);        
      }
    }

    $data['slug'] = $this->getSlug($data['name'], 'blog_categories', 'slug', $id);

    $post_category->update($data);

    return redirect()->route('blog_categories.index')->with('message', 'Registro atualizado com sucesso!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\BlogCategories  $post_category
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $data = $request->all();
    
    $posts = BlogPosts::whereIn('blog_category_id', $data['registro'])->get();
    $categories = BlogCategories::whereIn('id', $data['registro'])->get();
    foreach ($categories as $post_category) {
      $post_category->delete();
    }
    foreach ($posts as $post){
      $blog_gallery = BlogGallery::where('blog_id',$post->id)->get();
      foreach ($blog_gallery as $gallery){
        unlink($gallery->image);
        $gallery->delete();
      }
      unlink($post->image);
      $post->delete();
    }
    return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
  }

  private function validation(array $data)
  {
    $validator = [
      'name' => 'required|string|max:100',
	    'active' => 'nullable|boolean'
    ];

    $messages = [
    'name.required' => 'É necessário um nome para a categoria',
    'name.max' => 'O número máximo de caracteres é de 100'
    ];
    
    return Validator::make($data, $validator, $messages);
  }
}
