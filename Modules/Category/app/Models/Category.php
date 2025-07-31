<?php

namespace Modules\Category\Models;

use Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Category\Database\Factories\CategoryFactory;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "title",
        "description",
        "created_at",
        "updated_at"
    ];


    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

}
