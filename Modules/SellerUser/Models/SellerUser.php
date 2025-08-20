<?php

namespace Modules\SellerUser\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\TelephoneSeller\Models\TelephoneSeller;
use Modules\User\Models\User;

// use Modules\SellerUser\Database\Factories\SellerUserFactory;

class SellerUser extends Model
{
    use HasFactory;

    public $timestamps ;

        public function seller()
    {
        return $this->belongsTo(TelephoneSeller::class,"telephone_seller_id","id");
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    protected $table = "seller_users";
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "user_id",
        "telephone_seller_id"
    ];

    public function addNewSellerUser(array $request): ?SellerUser
    {
        return $this->query()->create($request);
    }





 
}
