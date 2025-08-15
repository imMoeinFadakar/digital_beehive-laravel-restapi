<?php

namespace Modules\Auth\Models;
use Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\TelephoneSeller\Models\TelephoneSeller;

class SellerUser extends Model
{
    use HasFactory;


    public  $timestamps = false;

      public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // این رابطه تعداد رفرال‌های کاربر رو میاره
    public function referrals()
    {
        return $this->hasManyThrough(
            User::class,    // مدل نهایی که می‌خوای بگیری (رفرال‌ها)
            User::class,    // مدل واسطه (کاربر SellerUser)
            'id',           // کلید اصلی کاربر
            'reffering_id', // فیلد ارجاع در جدول users
            'user_id',      // کلید کاربر در SellerUser
            'id'            // کلید اصلی در users
        );
    }

   public function seller()
    {
        return $this->belongsTo(TelephoneSeller::class);
    }
 

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "user_id",
        "telephone_seller_id"
    ];

    public function AddNewSellerUser(array $validated): ?SellerUser
    {
        return $this->query()->create($validated);
    }
}
