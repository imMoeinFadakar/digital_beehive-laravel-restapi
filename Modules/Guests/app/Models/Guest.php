<?php

namespace Modules\Guests\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Guests\Database\Factories\GuestFactory;

class Guest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "first_name",
        "last_name",
        "user_id",
        "phone",
        "tour_status"
    ];

    protected $hidden = [
        "user_id"
    ];

    public function addNewGuest(array $validated): ?Guest
    {
        return $this->query()->create($validated);
    }


    public function updateGuest()
    {
        
    }

    // protected static function newFactory(): GuestFactory
    // {
    //     // return GuestFactory::new();
    // }
}
