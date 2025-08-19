<?php

namespace Modules\Activities\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Activities\Database\Factories\ActivityUserFactory;

class ActivityUser extends Model
{
    use HasFactory;

    protected $table = "activity_users";

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "user_id",
        "activity_id"
    ];

    protected $hidden = [
        "created_at",
        "updated_at"
    ];

    public function addNewActivityUser(array $validated): ?ActivityUser
    {
        return $this->query()->create($validated);
    }
  
}
