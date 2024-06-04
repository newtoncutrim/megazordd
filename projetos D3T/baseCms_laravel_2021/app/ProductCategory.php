<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table = 'product_categories';
    protected $fillable = [
        'name',
    ];

    public function subCategories()
    {
        return $this->hasMany(ProductSubCategory::class, 'category_id');
    }
}
