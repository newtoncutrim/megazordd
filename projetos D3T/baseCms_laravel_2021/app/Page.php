<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = "pages";
    protected $fillable = [
        'location',
        'name',
        'description',
        'item',
        'phone',
        'image',
        'active',
        'cnpj',
        'video',
        'instagram',
        'facebook',
        'whatsapp',
        'street',
        'city',
        'CEP',
        'state',
        'district',
        'number'
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
