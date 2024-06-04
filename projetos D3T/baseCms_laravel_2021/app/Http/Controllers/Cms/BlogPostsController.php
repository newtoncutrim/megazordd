<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
Use App\Http\Controllers\Cms\RestrictedController;
use Illuminate\Validation\Rule;

use App\BlogPosts;
use App\BlogGallery;
use App\BlogCategories;

use App\Traits\UploadTrait;
use App\Traits\SlugTrait;


class BlogPostsController extends RestrictedController
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
    $headers = parent::headers(
      "Postagens",
      [
        [
          "icon" => "",
          "title" => "Postagens",
          "url" => ""
        ]
      ]
    );
    $titles = json_encode(['#', 'Status', 'Destaque', 'Nome','Categoria', 'Data agendada']);
    $actions = json_encode([
      [
        'path' => '{item}/edit',
        'icon' => 'fa fa-pencil',
        'label' => 'editar',
        'color' => 'primary'
      ],
      [
        'path' => '{item}/gallery',
        'icon' => 'fa fa-image',
        'label' => 'Imagens',
        'color' => 'primary'
      ]
    ]);
    $busca = '';
    $pagination = 15;
    if(!empty($data['busca'])){
      if($data['busca'] != null && $data['busca'] != ''){
        $busca = $data['busca'];
      }
    }
    $items = BlogPosts::select('id', 'active', 'highlight','name', 'blog_category_id', 'date')
    ->Where(function ($query) use ($data) {
      if(!empty($data['busca'])){
        $query->where('name', 'LIKE', "%".$data['busca']."%");
      }
    })
    ->orWhere(function ($query) use ($data) {
      if(!empty($data['busca'])){
        $query->where('date', 'LIKE', "%".$data['busca']."%");
      }
    })
    ->orWhere(function ($query) use ($data) {
      if (!empty($data['busca'])) {
        $query->where('active', 'LIKE', "%" . $data['busca'] . "%");
      }
    })
    ->orderBy('id', 'DESC')->paginate($pagination);

    foreach ($items as $item) {
      $item['active'] = [
        'type' => 'badge',
        'status' => $item['active'] == 1 ? 'success' : 'danger',
        'text' => $item['active'] == 1 ? 'Ativo' : 'Inativo'
      ];
			$item['highlight'] = [
        'type' => 'badge',
        'status' => $item['highlight'] == 1 ? 'success' : 'danger',
        'text' => $item['highlight'] == 1 ? 'Destaque' : 'Não destaque'
      ];
    }
  
    foreach ($items as $item) {
      $item->date = date("d/m/Y", strtotime($item->date));
      $guarda = BlogCategories::select('name')->where('id', $item->blog_category_id)->first();
      if (isset($guarda->name)) {
        $item->blog_category_id = $guarda->name;
      } else {
        $item->blog_category_id = '';
      }
    }

    $categoryList = [];
    $categories = BlogCategories::where('active','1')->get();
    foreach ($categories as $key => $category) {
      $categoryList[$key]['value'] = $category->id;
      $categoryList[$key]['label'] = $category->name;
    }

    foreach ($items as $key => $value) {
      if (empty($items[$key]->date)) {
        $items[$key]->date = 'Não possui';
      }
      
    }

    return view("cms.blog.posts.index", compact('headers', 'titles', 'items', 'actions', 'categoryList', 'busca'));
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
    $data['time'] = substr($data['date'], 11);
    $data['date'] = substr($data['date'],0,10);
    if (!isset($data['active'])) {
      $data['active'] = 0;
		}

		if (!isset($data['highlight'])) {
			$data['highlight'] = 0;
		}

    $validation = $this->validation($data, 'store');
    if ($validation->fails()) {
      return redirect()->back()->withErrors($validation)->withInput();
    }

    $data['slug'] = $this->getSlug($data['name'], 'blog_posts');

    if (!empty($data['image'])) {
      if (!$image = $this->uploadValidFile('blogs', $data['image'], 800)) {
        return redirect()->back()->withErrors(['errors' => 'image cannot be uploaded'])->withInput();
      }
    }

    if (!empty($image)){
      $data['image'] = $image;
    }
    BlogPosts::create($data);

    return redirect()->back()->with('message', 'Registro cadastrado com sucesso!');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Blog  $blog
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $blog = BlogPosts::find($id);
    #PAGE TITLE E BREADCRUMBS
    $headers = parent::headers(
      "Postagens",
      [
        ["icon" => "", "title" => "Postagens", "url" => route('blog_posts.index')],
        ["icon" => "", "title" => "Editar", "url" => ""],
      ]
    );

    if (empty($blog)) {
      return redirect()->back();
    }

    $categoryList = [];
    $categories = BlogCategories::get();
    foreach ($categories as $key => $category) {
      $categoryList[$key]['value'] = $category->id;
      $categoryList[$key]['label'] = $category->name;
    }

    
    return view('cms.blog.posts.edit', compact('headers', 'blog', 'categoryList'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Blog  $blog
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $blog = BlogPosts::find($id);
    $data = $request->all();

    if (!isset($data['active'])) {
			$data['active'] = 0;
		}

		if (!isset($data['highlight'])) {
			$data['highlight'] = 0;
		}

    $data['time'] = substr($data['date'], 11);
    $data['date'] = substr($data['date'],0,10);
    $validation = $this->validation($data, 'update');
    if ($validation->fails()) {
      return redirect()->back()->withErrors($validation)->withInput();
    }

    $data['slug'] = $this->getSlug($data['name'], 'blog_posts', 'slug', $blog->id);

    $image = $blog->image;
    if ($request->hasFile('image')) {
      if (!$image = $this->uploadValidFile('blog_posts', $data['image'], 800)) {
        return redirect()->back()->withErrors(['errors' => 'image cannot be uploaded'])->withInput(); 
      }

      unlink($blog->image);
    }


    $data['image'] = $image;

    $blog->update($data);

    return redirect()->route('blog_posts.index')->with('message', 'Registro atualizado com sucesso!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Blog  $blog
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
    $data = $request->all();
    
    $blogs = BlogPosts::whereIn('id', $data['registro'])->get();
    foreach ($blogs as $blog) {
      $blog_gallery = BlogGallery::where('blog_id',$blog->id)->get();
      foreach ($blog_gallery as $gallery) {
        unlink($gallery->image);
        $gallery->delete();
      }
      if (!empty($blog->image)) {
        unlink($blog->image);
      }
      $blog->delete();
    }
    
    return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
  }

  private function validation(array $data, $function = 'store')
  {
    $validator = [
      'name' => 'required|string|max:150',
      'lead' => 'nullable|string|max:200',
      'description' => 'required|string',
      'image' => 'required|image',
      'user' => 'required|string',
      'video' => 'nullable|string',
      'blog_category_id' => 'required|string',
      'active' => 'nullable|boolean'
    ];

    $messages = [
      'image' => 'A imagem não pode ser carregada',
      'image.required' => 'É necessário preencher o campo de imagem',
      'name.required' => 'É necessário um nome para a notícia',
      'user.required' => 'É necessário preencher o nome do autor',
      'description.required' => 'É necessária uma descrição para a notícia',
      'name.max' => 'O número máximo de caracteres é de 150',
      'lead.max' => 'O número máximo de caracteres é de 200',
      'blog_category_id.required' => 'É necessário escolher uma categoria'
    ];

    $data['description'] = strip_tags($data['description']) != '' ? $data['description'] : '';

    if ($function == 'update') {
      $validator['image'] = 'nullable|image';
    }

    return Validator::make($data, $validator, $messages);
  }

	public function preview($slug)
		{
			$blog_post = BlogPosts::where('slug', $slug)->first();
			$blog_gallery = BlogGallery::where('blog_id', $blog_post->id)->get();

			$blog_post->image = asset($blog_post->image);

			$blog_post->blog_category_id = BlogCategories::select('name')->where('id', $blog_post->blog_category_id)->first()['name'];

			$blog_post->date = strftime('%d de %B, %Y', strtotime($blog_post->date));

			$blog_post->time = date('H\hm', strtotime($blog_post->time));

			foreach ($blog_gallery as $photo) {
				$photo->image = asset($photo->image);
			}

			$today = date('Y-m-d');
			$news = BlogPosts::where('date', '<=', $today)->orderBy('date', 'DESC')->limit(6)->get();
			$news_categories = BlogCategories::select('name','id')->get();
			foreach ($news as $new){
				$new->date = strftime('%d de %B, %Y', strtotime($new->date));
				foreach($news_categories as $category){
					if ($new->blog_category_id == $category->id){
						$new->category = $category->name;
					}
				}
			}

			return view('website.blog.internal', compact('blog_post', 'blog_gallery', 'news'));
		}
}
