<?php

namespace Modules\ProductCode\Models;

use Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SellerProduct\Models\SellerProduct;

// use Modules\ProductCode\Database\Factories\ProductCodeFactory;

class productCode extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): ProductCodeFactory
    // {
    //     // return ProductCodeFactory::new();
    // }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function seller_product()
    {
        return $this->hasMany(SellerProduct::class);
    }

    public function updateProductCode(array $validated): ?static
    {
        $this->update($validated);
        return $this;
    }



}
