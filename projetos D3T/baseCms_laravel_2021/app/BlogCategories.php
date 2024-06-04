<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategories extends Model
{
    protected $table = "blog_categories";
    protected $fillable = [
        'active',
        'name',
        'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
