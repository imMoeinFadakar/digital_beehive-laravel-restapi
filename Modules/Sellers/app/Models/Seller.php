<?php

namespace Modules\Sellers\Models;

use Modules\User\Models\User;
use Modules\Sellers\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SellerProduct\Models\SellerProduct;

// use Modules\Sellers\Database\Factories\SellerFactory;

class Seller extends Model
{
    use HasFactory,UuidTrait;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "user_id",
        "seller_code",
        "total_commission"
    ];
    protected $hidden = [
        "created_at",
        "updated_at",
        "user_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class,"user_id","id");
    }
    public function seller_product()
    {
        return $this->hasMany(SellerProduct::class);
    }

    public function addNewSeller(): ?Seller
    {
        return $this->query()->create(
        ['user_id' => auth()->id(),
        "seller_code" => $this->generateUniqueCode("sellers","seller_code",7)]);
    }




}
