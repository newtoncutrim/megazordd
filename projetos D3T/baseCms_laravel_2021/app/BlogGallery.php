<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogGallery extends Model
{
    protected $table = "blog_gallery";
    protected $fillable = [
        'blog_id',
        'image'
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

    public function blog()
    {
        return $this->belongsTo('App\BlogPosts', 'blog_id');
    }

}
