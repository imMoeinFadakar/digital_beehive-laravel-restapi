<?php

namespace Modules\OTP\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\OTP\Database\Factories\OtpFactory;

class Otp extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "code",
        "phone",
        "expires_at"
    ];

    public function addNewOtp(array $validated)
    {
        return $this->query()->create($validated);
    }


    // protected static function newFactory(): OtpFactory
    // {
    //     // return OtpFactory::new();
    // }
}
