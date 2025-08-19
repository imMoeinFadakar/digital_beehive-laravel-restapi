<?php

namespace Modules\Beehive\Models;

use Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Beehive\Database\Factories\BeehiveFactory;

class Beehive extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "user_id",
        "bee_count",
        "frame_count",
        "refferal_code",
        "honey_amount",
      "power",
    ];


    protected $hidden = [
        "user_id",
        "created_at",
        "updated_at"
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addNewBeehive(array $validated): ?Beehive
    {
        return $this->query()->create($validated);
    }

    public function updateBeehive(array $validated): ?static
    {
      $this->update($validated);
      return $this;
    }

    public function deleteBeehive(): ?bool
    {
        return $this->delete();
    }


}
