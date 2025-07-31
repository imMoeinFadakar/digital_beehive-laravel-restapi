<?php

namespace Modules\Activity\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Activity\Database\Factories\ActivityFactory;

class Activity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "title",
        "description",
        "image",
        "reward"
    ];

   public function activity()
   {
        return $this->hasMany(Activity::class);
   }


}
