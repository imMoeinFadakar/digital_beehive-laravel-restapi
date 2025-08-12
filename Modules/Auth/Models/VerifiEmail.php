<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Auth\Database\Factories\VerifiEmailFactory;

class VerifiEmail extends Model
{
    use HasFactory,Notifiable;

    protected $table = "eamil_verification_token";


    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "email",
        "code",
        "expire_at"
    ];


    public function getVerifiCode(array $validated)
    {
        return $this->where("email",$validated['email'])
        ->where("code",$validated['code'])
        ->first();
    }


    public function addNewVerifiEmail(array $validated): ?VerifiEmail
    {
        return $this->query()->create($validated);
    }


    
}
