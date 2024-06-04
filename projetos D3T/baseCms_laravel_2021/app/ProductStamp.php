<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStamp extends Model
{
    use HasFactory;
    protected $table = 'product_stamps';
    protected $fillable = [
        'name',
        'product_id',
        'image'
    ];

    public function product()
    {
      return $this->belongsTo(Product::class);
    }

}
