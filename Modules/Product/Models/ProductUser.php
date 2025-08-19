<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Product\Database\Factories\ProductUserFactory;

class ProductUser extends Model
{
    use HasFactory;


    protected $table = "product_users";

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['user_id','product_id'];

   
}
