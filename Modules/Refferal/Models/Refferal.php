<?php

namespace Modules\Refferal\Models;

use Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Refferal\Database\Factories\RefferalFactory;

class Refferal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "reffered_id",
        "reffering_id",
        "reward_status"
    ];

    public function reffered()
    {
        return $this->belongsTo(User::class,"reffered_id","id");
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'reffering_id', 'id');
    }

    public function addNewRefferal(array $refferalInfo): ?Refferal
    {
        return $this->query()->create($refferalInfo);
    }
}
