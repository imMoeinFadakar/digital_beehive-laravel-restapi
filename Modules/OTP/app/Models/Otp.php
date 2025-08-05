<?php

namespace Modules\Otp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Otp\Database\Factories\OtpFactory;

class Otp extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "phone_number",
        "otp_code",
        "expires_at"
    ];


    protected $hidden = [
        "phone_number"
    ];


    public function addNewOtpCode(array $validated): ?Otp
    {
        return $this->query()->create($validated);
    }

  

    // protected static function newFactory(): OtpFactory
    // {
    //     // return OtpFactory::new();
    // }
}
