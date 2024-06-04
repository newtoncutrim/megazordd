<?php

namespace App\Http\Controllers\Cms;

use App\BlogGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
Use App\Http\Controllers\Cms\RestrictedController;
use Illuminate\Validation\Rule;
use App\BlogPosts;
use App\Traits\UploadTrait;

class BlogGalleryController extends RestrictedController
{
  use UploadTrait;
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index($id)
  {
    $blog = BlogPosts::find($id);
    $headers = parent::headers(
      "Imagens de Blog",
      [
        [
          "icon" => "",
          "title" => "Postagens",
          "url" => route('blog_posts.index')
        ],
        [
          "icon" => "",
          "title" => "Imagens do Blog",
          "url" => ""
        ]
      ]
    );
    $titles = json_encode(['#', 'Imagem']);
    $actions = json_encode([]);
    $items = BlogGallery::where('blog_id', $blog['id'])->paginate();
    foreach ($items as $key => $value) {
      unset($value->blog_id);
      $items[$key]->image = [
        "type" => 'img',
        "src"=> asset($value->image)
      ];
    }
    return view("cms.blog.gallery.index", compact('headers', 'titles', 'items', 'actions', 'blog'));
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
    
    $data['blog_id'] = $id;
    $files = $request->file('attachments');
    foreach ($files as $file) {
      if (!$image = $this->uploadValidFile('blogs', $file, 800)) {
        return redirect()->back()->withErrors(['errors' => 'image cannot be uploaded'])->withInput();
      }

      $data['image'] = !empty($image) ? $image : '';
      $image = BlogGallery::create($data);
    }
    
    return 'Registro cadastrado com sucesso!';
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(BlogPosts $blog, Request $req)
  {
    $items = BlogGallery::whereIn('id',$req['registro'])->get();

    foreach ($items as $item) {
      if(!empty($item->image)){
        unlink($item->image);
      }
      $item->delete();
    }

    return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
  }
}
