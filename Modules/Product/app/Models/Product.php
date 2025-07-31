<?php

namespace Modules\Product\Models;

use Modules\Category\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Modules\ProductCode\Models\ProductCode;
use Modules\UserProduct\Models\UserProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// use Modules\Product\Database\Factories\ProductFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    public function seller_product()
    {
        
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function product_code()
    {
        return $this->hasMany(ProductCode::class);
    }

  
}
