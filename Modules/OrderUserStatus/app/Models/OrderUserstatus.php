<?php

namespace Modules\OrderUserStatus\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\OrderUserStatus\Database\Factories\OrderUserstatusFactory;

class OrderUserstatus extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "description",
        "user_id",
        "title",
        "status"
    ];

    public function addNewOrderUserStatus(array $request): ?OrderUserstatus
    {
        return $this->query()->create($request);
    }




    // protected static function newFactory(): OrderUserstatusFactory
    // {
    //     // return OrderUserstatusFactory::new();
    // }
}
