<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileProduct extends Model
{
    use HasFactory;

    protected $table = "file_products";
    protected $fillable = [
      'gallery',
      'attachments_pdfs',
      'product_id',
    ];

    public function product()
    {
      return $this->belongsTo(Product::class);
    }
}
