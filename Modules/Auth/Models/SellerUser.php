<?php

namespace Modules\Auth\Models;
use Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\TelephoneSeller\Models\TelephoneSeller;

class SellerUser extends Model
{
    use HasFactory;


    public  $timestamps = false;


    public function user()
    {
        return $this->belongsTo(User::class);
    }
   public function seller()
    {
        return $this->belongsTo(TelephoneSeller::class);
    }


    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "user_id",
        "telephone_seller_id"
    ];

    public function AddNewSellerUser(array $validated): ?SellerUser
    {
        return $this->query()->create($validated);
    }
}
