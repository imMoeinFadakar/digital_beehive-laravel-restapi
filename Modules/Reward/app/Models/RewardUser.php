<?php

namespace Modules\Reward\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Reward\Database\Factories\RewardUserFactory;

class RewardUser extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "Reward_id",
        "user_id",
        "status"
    ];
    protected $hidden = [
        "user_id",
        "created_at",
        "updated_at"
    ];

    public function addNewRewardUser(array $validated): ?RewardUser
    {
        return $this->query()->create($validated);
    }

    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }


}
