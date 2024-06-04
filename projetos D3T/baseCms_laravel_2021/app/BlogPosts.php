<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPosts extends Model
{
  protected $table = "blog_posts";
  protected $fillable = [
    'active',
    'slug',
    'blog_category_id',
    'name',
    'lead',
    'description',
    'image',
    'video',
    'date',
    'user',
    'time',
		'highlight'
  ];
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'created_at',
    'updated_at'
  ];

  public function category()
  {
    return $this->belongsTo('App\BlogCategories', 'blog_category_id');
  }
/* 
  public function gallery()
  {
    return $this->hasMany('App\BlogGallery');
  }
 */
}
