<?php

namespace Modules\OrderUser\Models;

use Modules\User\Models\User;
use Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\OrderUser\Database\Factories\OrderUserFactory;

class OrderUser extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "user_id",
        "product_id",
        "quentity"
    ];


    protected $hidden = [
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function AddNewOrderUser(array $validated): ?OrderUser
    {
        return $this->query()->create($validated);
    }

    public function updateOrderUser(array $validated): ?static
    {
        $this->update($validated);
        return $this;
    }

}
