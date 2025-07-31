<?php

namespace Modules\Guests\Models;

use Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Guests\Database\Factories\GuestCardFactory;

class GuestCard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "user_id",
        "code",
        "status"
    ];

    protected $hidden = [
        "user_id"
    ];

   public function user()
   {
        return $this->belongsTo(User::class);
   }

   public function addNewGuestCode()
   {
    
   }


}
