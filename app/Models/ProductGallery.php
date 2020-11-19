<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGallery extends Model
{
    protected $fillable = [
        'products_id', 'photos', 'is_default'
    ];
    protected $hidden = [];

    public function Product()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
    public function getPhotosAttribut($value)
    {
        return url('storage/' . $value);
    }
}
