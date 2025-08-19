<?php

namespace Modules\Refferal\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Refferal\Database\Factories\CardUserFactory;

class CardUser extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "user_id",
        "card_id"
    ];


    protected $hidden = [
        "user_id"
    ];


    public function card()
    {
        return $this->belongsTo(Card::class);
    }



    // protected static function newFactory(): CardUserFactory
    // {
    //     // return CardUserFactory::new();
    // }
}
