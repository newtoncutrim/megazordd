<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configurations extends Model
{
    protected $table = "configurations";
    protected $fillable = [
        'keywords',
        'description',
        'title',
        'whatsapp',
        'form_email',
        'email',
        'phone',
        'instagram',
        'linkedin',
        'facebook'
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
}
