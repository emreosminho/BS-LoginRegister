<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'stock_code',
        'product_name',
        'product_type',
        'car_type',
        'product_brand_id',
        'unit',
        'photo',
    ];

    public function brand()
    {
        return $this->belongsTo(ProductBrand::class, 'product_brand_id');
    }
}
