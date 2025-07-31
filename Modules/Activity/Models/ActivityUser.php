<?php

namespace Modules\Activity\Models;

use Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Activity\Database\Factories\ActivityUserFactory;

class ActivityUser extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "activity_id",
        "user_id"
    ];


    protected $hidden = [
        "user_id",
        "created_at",
        "updated_at"
    ];

    public function addNewActivityUser(array $validated)
    {
        return $this->query()->create($validated);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }


}
