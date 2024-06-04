<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory;

  protected $table = "products";
  protected $fillable = [
    'title',
    'descriptive',
    'description',
    'stamps',
    'order',
    'image',
    'sub_category_id',
  ];

  protected $hidden = [
    'updated_at',
    'created_at'
  ];

  protected $appends = ['sub_category'];

  public function getSubCategoryAttribute() {
    $subCategory = ProductSubCategory::find($this->sub_category_id);
    return $subCategory ? $subCategory->name : '';
  }
  
  public function subCategory()
  {
    return $this->belongsTo(ProductSubCategory::class);

  }
  public function getSubCategoryNameAttribute()
  {
    return $this->subCategory->name ?? '';
  }
  public function files()
  {
    return $this->hasMany(FileProduct::class, 'product_id');
  }

  public function selos()
  {
    return $this->hasMany(ProductStamp::class, 'product_id');
  }
  
}
