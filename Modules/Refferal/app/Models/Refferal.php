<?php

namespace Modules\Refferal\Models;

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

    public function addNewRefferal(array $refferalInfo): ?Refferal
    {
        return $this->query()->create($refferalInfo);
    }
}
