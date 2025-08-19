<?php

namespace Modules\Activities\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Activities\Database\Factories\ActivityFactory;

class Activity extends Model
{
    use HasFactory;

    protected $table = "activities";


    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): ActivityFactory
    // {
    //     // return ActivityFactory::new();
    // }
}
