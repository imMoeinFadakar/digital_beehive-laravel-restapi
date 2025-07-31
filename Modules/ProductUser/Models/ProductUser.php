<?php

namespace Modules\ProductUser\Models;

use Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\ProductUser\Database\Factories\ProductUserFactory;

class ProductUser extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "user_id",
        "product_id",
        "product_code_id",
    ];

    protected $hidden = [
        "user_id",
        "created_at",
        "updated_at"
    ];


    // protected static function newFactory(): ProductUserFactory
    // {
    //     // return ProductUserFactory::new();
    // }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function addNewProductUser(array $validated): ?ProductUser
    {
        return $this->query()->create($validated);
    }


}
