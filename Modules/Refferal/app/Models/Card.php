<?php

namespace Modules\Refferal\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Refferal\Database\Factories\CardFactory;

class Card extends Model
{
    use HasFactory;


    public function card_user()
    {
        return $this->hasMany(CardUser::class);
    }


    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): CardFactory
    // {
    //     // return CardFactory::new();
    // }
}
