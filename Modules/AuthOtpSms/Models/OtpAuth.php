<?php

namespace Modules\AuthOtpSms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\AuthOtpSms\Database\Factories\OtpAuthFactory;

class OtpAuth extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
           'phone' ,
            'code' ,
            'expires_at',
            "used" 
    ];

    public function addNewOtpAuth($request): ?OtpAuth
    {
        return $this->query()->create($request);
    }


}
