<?php

namespace Modules\TelephoneSeller\Models;

use Modules\Auth\Models\SellerUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

// use Modules\TelephoneSeller\Database\Factories\TelephoneSellerFactory;

class TelephoneSeller extends Authenticatable
{
    use HasFactory,Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "id",
          "first_name",
        "last_name",
        "national_code",
        "issue_place",
        "birth_date",
        "married_status",
        "address",
        "emergency_phone",
        "any_teammate_family",
        "extera_activity",
        "health_status",
        "punishment_history",
        "personel_code",
        "password",
        "score",
        "educational_background",
        'field_of_study',
        'institution_name',
        'Position',
        "field_of_activity",
        "image"
    ];

    protected $cast = [
        "password" => "hash"
    ];


    public function Seller_user()
    {
        return $this->hasMany(SellerUser::class);
    }



   public function addNewTelephoneSeller(array $validated): ?TelephoneSeller
   {
        return $this->query()->create($validated);
   }
}
