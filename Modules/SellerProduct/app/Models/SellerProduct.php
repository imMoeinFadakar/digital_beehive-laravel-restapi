<?php

namespace Modules\SellerProduct\Models;

use Modules\Sellers\Models\Seller;
use Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Modules\ProductCode\Models\productCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// use Modules\SellerProduct\Database\Factories\SellerProductFactory;

class SellerProduct extends Model
{
    use HasFactory;

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "seller_id",
        "product_code_id",
        "commission"
    ];

    // relations 
    public function product_code()
    {
        return $this->belongsTo(productCode::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }


    public function addNewSellerProduct(array $attributes): ?SellerProduct
    {
        return $this->query()->create($attributes);
    }



  
}
